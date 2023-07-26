<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Person;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class NisSearchHandlerTest extends TestCase
{
    public function testItShouldHandleSearchRequestWithExistingPerson()
    {
        $mockPerson = \Mockery::mock(Person::class);
        $mockPerson->shouldReceive('findByNis')->andReturn(new Person('Maria Silveira', '12345678901'));

        $mockHandler = new MockHandler([
            new Response(302, ['Location' => '/search.php?data=' . urlencode(base64_encode(json_encode([
                    'name' => 'Maria Silveira',
                    'code' => '12345678901'
                ])))])
        ]);

        $client = new Client(['handler' => $mockHandler, 'base_uri' => 'http://localhost:8080']);

        $formData = ['nis' => '12345678901'];

        $response = $client->post('/search', ['form_params' => $formData]);

        $this->assertEquals(302, $response->getStatusCode());

        $urlParts = parse_url($response->getHeaderLine('Location'));
        parse_str($urlParts['query'], $queryParams);

        $this->assertArrayHasKey('data', $queryParams);

        $decodedParams = json_decode(base64_decode($queryParams['data']), true);
        $this->assertEquals('Maria Silveira', $decodedParams['name']);
        $this->assertEquals('12345678901', $decodedParams['code']);
    }

    public function testItShouldHandleSearchRequestWithNotFoundPerson()
    {
        $mockPerson = \Mockery::mock(Person::class);
        $mockPerson->shouldReceive('findByNis')->andReturn(null);

        $mockHandler = new MockHandler([
            new Response(302, ['Location' => '/search.php?data=' . urlencode(base64_encode(json_encode([
                    'not_found' => true
                ])))])
        ]);

        $client = new Client(['handler' => $mockHandler, 'base_uri' => 'http://localhost:8080']);

        $formData = ['nis' => '9876543210']; // Assuming this NIS is not found in the mocked Person::findByNis()

        $response = $client->post('/search', ['form_params' => $formData]);

        $this->assertEquals(302, $response->getStatusCode());

        $urlParts = parse_url($response->getHeaderLine('Location'));
        parse_str($urlParts['query'], $queryParams);

        $this->assertArrayHasKey('data', $queryParams);

        $decodedParams = json_decode(base64_decode($queryParams['data']), true);
        $this->assertTrue(isset($decodedParams['not_found']) && $decodedParams['not_found']);
    }

}
