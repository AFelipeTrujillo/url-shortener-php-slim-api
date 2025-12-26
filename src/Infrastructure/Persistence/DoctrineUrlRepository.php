<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Url;
use App\Domain\Repository\UrlRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PhpParser\Lexer\TokenEmulator\EnumTokenEmulator;

class DoctrineUrlRepository implements UrlRepositoryInterface
{
    private EntityManager $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Url::class);
    }

    public function save(Url $url): void
    {
        $this->entityManager->persist($url);
        $this->entityManager->flush();
    }

    public function findByCode(string $code): ?Url
    {
        return $this->repository->findOneBy(['shortCode' => $code]);
    }

    public function findByOriginalUrl(string $url): ?Url
    {
        return $this->repository->findOneBy(['originalUrl' => $url]);
    }

}