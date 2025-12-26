<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

$container = require __DIR__ . '/../config/container.php';
$entityManager = $container->get(\Doctrine\ORM\EntityManager::class);


ConsoleRunner::run(new SingleManagerProvider($entityManager));