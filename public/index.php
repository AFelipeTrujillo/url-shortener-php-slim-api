<?php

use App\Application\Actions\PingAction;
use App\Application\Actions\ShortenUrlAction;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$container = require __DIR__ . '/../config/container.php';
AppFactory::setContainer($container);

$app = AppFactory::create();

// add routing middleware
$app->addBodyParsingMiddleware();

$app->get('/ping', PingAction::class);
$app->post('/shorten', ShortenUrlAction::class);

$app->run();