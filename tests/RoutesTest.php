<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class RoutesTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client(['base_uri' => 'http://localhost:8080']);
    }

    public function testHomePage()
    {
        $response = $this->client->get('/');

        $content = $response->getBody()->getContents();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Bem-vindo à Página Inicial', $content);
        $this->assertStringContainsString('Cadastrar NIS', $content);
        $this->assertStringContainsString('Pesquisar NIS', $content);
    }

    public function testRegistrationPage()
    {
        $response = $this->client->get('/cadastrar');

        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getBody()->getContents();

        $this->assertStringContainsString('Cadastrar NIS', $content);
        $this->assertStringContainsString('<form method="post" action="/cadastrar">', $content);
        $this->assertStringContainsString('<input type="text" maxlength="50" name="name" required>', $content);
        $this->assertStringContainsString('<input class="button" type="submit" value="Cadastrar">', $content);
        $this->assertStringContainsString('<a href="/"><i class="fas fa-arrow-left"></i> Voltar para a página inicial</a>', $content);
    }

}
