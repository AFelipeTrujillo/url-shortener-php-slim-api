<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Url;

interface UrlRepositoryInterface
{
    public function save(Url $url): void;
    public function findByCode(string $code): ?Url;
    public function findByOriginalUrl(string $url): ?Url;
}