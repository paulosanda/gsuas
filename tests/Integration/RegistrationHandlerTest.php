<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database\Database;
use App\Person;
use App\RegistrationHandler;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

class RegistrationHandlerTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    public function testItShouldRegisterANewCitizen()
    {
        $mockDatabase = Mockery::mock(Database::class);
        $handler = new RegistrationHandler();
        $handler->setDatabase($mockDatabase);

        $mockHandler = new MockHandler([
            new Response(302, ['Location' => '/registration.php'])
        ]);

        $client = new Client(['handler' => $mockHandler, 'base_uri' => 'http://localhost']);

        $formData = ['name' => 'Carlos Silveira'];

        $mockDatabase
            ->shouldReceive('getConnection')
            ->andReturn($mockDatabase);

        $mockDatabase
            ->shouldReceive('prepare')
            ->with('INSERT INTO persons (name, nis) VALUES (:name, :nis)')
            ->andReturn($mockDatabase);

        $mockDatabase
            ->shouldReceive('execute')
            ->with(['name' => 'John Doe', 'nis' => Mockery::type('string')])
            ->andReturn(true);

        $response = $client->post('/cadastrar', ['form_params' => $formData]);

        assertEquals(302, $response->getStatusCode());
        assertEquals('/registration.php', $response->getHeaderLine('Location'));
    }
}
