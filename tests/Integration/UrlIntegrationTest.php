<?php

namespace Tests\Integration;

use App\Domain\Entity\Url;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\RequestFactory;
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManager;

class UrlIntegrationTest extends TestCase
{
    private $app;
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        $container = require __DIR__ . '/../../config/container.php';
        AppFactory::setContainer($container);

        $this->app = AppFactory::create();
        $this->entityManager = $this->app->getContainer()->get(EntityManager::class);

        $this->app->addBodyParsingMiddleware();
        $this->app->post('/shorten', \App\Application\Actions\ShortenUrlAction::class);
    }

    public function testShortenUrlSuccessfully()
    {
        // 1. Create the request
        $factory = new RequestFactory();
        $request = $factory
            ->createRequest('POST', '/shorten')
            ->withHeader('Content-Type', 'application/json')
        ;

        $request->getBody()->write(
            json_encode(['url' => 'https://www.google.com'])
        );
        // Rewind the body stream after writing
        $request->getBody()->rewind();

        // 2. Handle the request
        $response = $this->app->handle($request);
        $payload = json_decode((string) $response->getBody(), true);
        
        // 3. Assert the response
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertArrayHasKey('original_url', $payload);
        $this->assertArrayHasKey('short_url', $payload);

        // 4. Verify that the URL is stored in the database
        $url = $this
            ->entityManager
            ->getRepository(Url::class)
            ->findOneBy(['originalUrl' => 'https://www.google.com'])
        ;

        $this->assertNotNull($url);
    }


}