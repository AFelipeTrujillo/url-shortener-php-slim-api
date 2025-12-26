<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/container.php';
$entityManager = $container->get(\Doctrine\ORM\EntityManager::class);


ConsoleRunner::run(new SingleManagerProvider($entityManager));