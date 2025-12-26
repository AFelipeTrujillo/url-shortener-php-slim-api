<?php

namespace App\Application\Services;

use App\Domain\Entity\Url;
use App\Domain\Repository\UrlRepositoryInterface;
use App\Domain\Service\CodeGeneratorInterface;
use InvalidArgumentException;

class ShortenerService
{
    private UrlRepositoryInterface $urlRepository;
    private CodeGeneratorInterface $codeGenerator;

    public function __construct(UrlRepositoryInterface $urlRepository, CodeGeneratorInterface $codeGenerator)
    {
        $this->urlRepository = $urlRepository;
        $this->codeGenerator = $codeGenerator;
    }

    public function shortenUrl(string $originalUrl): Url
    {
        if (!filter_var($originalUrl, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid URL format.');
        }

        $existingUrl = $this->urlRepository->findByOriginalUrl($originalUrl);
        if ($existingUrl) {
            return $existingUrl;
        }

        do {
            $shortCode = $this->codeGenerator->generateCode();
            $existingCode = $this->urlRepository->findByCode($shortCode);
        } while ($existingCode !== null);

        $url = new Url($originalUrl, $shortCode);

        $this->urlRepository->save($url);

        return $url;
    }

    public function getOriginalUrl(string $shortCode): ?string
    {
        $url = $this->urlRepository->findByCode($shortCode);
        return $url ? $url->getOriginalUrl() : null;
    }
}