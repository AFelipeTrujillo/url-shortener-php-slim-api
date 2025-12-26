<?php

use App\Domain\Repository\UrlRepositoryInterface;
use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use App\Domain\Service\CodeGeneratorInterface;
use App\Shared\Base62Generator;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    EntityManager::class => function () {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . '/../src/Domain/Entity'],
            true,
        );

        // Database connection configuration
        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path'   => __DIR__ . '/../var/url_shortener.sqlite',
        ], $config);

        return new EntityManager($connection, $config);
    },
    UrlRepositoryInterface::class => \DI\autowire(\App\Infrastructure\Persistence\DoctrineUrlRepository::class),
    CodeGeneratorInterface::class => \DI\autowire(Base62Generator::class),
]);

return $containerBuilder->build();
