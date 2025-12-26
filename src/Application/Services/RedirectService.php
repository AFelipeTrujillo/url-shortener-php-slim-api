<?php

namespace App\Application\Services;

use App\Domain\Entity\Url;
use App\Domain\Repository\UrlRepositoryInterface;
use Exception;

class RedirectService
{
    public function __construct(
        private UrlRepositoryInterface $urlRepository
    ){ }

    public function execute(string $shortCode): Url
    {
        // 1. Find the original URL by its short code
        $url = $this->urlRepository->findByCode($shortCode);

        if (!$url) {
            throw new Exception('Short URL not found.');
        }

        $url->incrementVisits();

        $this->urlRepository->save($url);

        return $url;
    }
}

