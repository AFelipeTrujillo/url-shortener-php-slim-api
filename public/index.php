<?php

use App\Application\Actions\PingAction;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/container.php';
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/ping', PingAction::class);

$app->run();