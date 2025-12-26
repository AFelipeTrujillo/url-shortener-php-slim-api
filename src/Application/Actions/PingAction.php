<?php

namespace App\Application\Actions;

use App\Application\Services\PingService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PingAction {
    private PingService $pingService;

    public function __construct(PingService $pingService) {
        $this->pingService = $pingService;
    }

    public function __invoke(Request $request, Response $response): Response {
        $result = $this->pingService->ping();

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }
}