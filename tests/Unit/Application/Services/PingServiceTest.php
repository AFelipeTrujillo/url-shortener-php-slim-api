<?php

namespace Tests\Unit\Application\Services;

use App\Application\Services\PingService;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Connection;
use PHPUnit\Framework\TestCase;

class PingServiceTest extends TestCase
{   
    
    public function testExecuteReturnOkWhenDatabaseIsConnect() 
    {
        $connectionMock = $this->createMock(Connection::class);

        $entityManagerMock = $this->createMock(EntityManager::class);
        $entityManagerMock->method('getConnection')->willReturn($connectionMock);

        $pingService = new PingService($entityManagerMock);
        $result = $pingService->ping();
        
        $this->assertEquals('ok', $result['status']);
        $this->assertEquals('connected', $result['database']);
    }
}