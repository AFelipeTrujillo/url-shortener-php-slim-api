<?php

namespace App\Application\Actions;

use App\Application\Services\ShortenerService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ShortenUrlAction 
{
    public function __construct(private ShortenerService $shortenUrlService) { }

    public function __invoke(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $originalUrl = $data['url'] ?? '';

        try {
            $urlEntity = $this->shortenUrlService->shortenUrl($originalUrl);

            $payload = [
                'original_url' => $urlEntity->getOriginalUrl(),
                'short_url' => "http://localhost:8080/" . $urlEntity->getShortCode(),
            ];

            $response->getBody()->write(json_encode($payload));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);

        } catch (\InvalidArgumentException $e) {
            $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }
    }
}

