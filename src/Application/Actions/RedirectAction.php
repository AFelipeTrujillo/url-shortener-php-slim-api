<?php

namespace App\Application\Actions;

use App\Application\Services\RedirectService;
use Psr\Http\Message\ResponseInterface as Respose;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;

class RedirectAction
{
    public function __construct(private RedirectService $redirectService) { }
    
    public function __invoke(Request $request, Respose $response, array $args): Respose
    {
        $code = $args['code'] ?? '';

        if (empty($code)) {
            throw new HttpNotFoundException($request, 'Short URL code is missing.');
        }

        try {

            $url = $this->redirectService->execute($code);
            return $response
                ->withHeader('Location', $url->getOriginalUrl())
                ->withStatus(302)
            ;

        } catch (\Exception $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }
    }
}