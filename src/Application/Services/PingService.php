<?php

namespace Application\Services;
use Doctrine\ORM\EntityManager;

class PingService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function ping(): array
    {
        try {
            $connection = $this->entityManager->getConnection();
            $connection->executeQuery('SELECT 1');
            return [
                'status' => 'ok',
                'database' => 'connected',
                'time' => time()
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'time' => time(),
            ];
        }
    }
}