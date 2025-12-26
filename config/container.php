<?php

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    EntityManager::class => function () {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . '/../src/Domain/Entity'],
            true,
        );

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path'   => __DIR__ . '/../var/url_shortener.sqlite', // El archivo se creará aquí
        ], $config);

        return new EntityManager($connection, $config);
    },
]);

return $containerBuilder->build();
