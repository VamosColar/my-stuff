<?php
declare(strict_types = 1);

//require_once __DIR__ .'/../vendor/autoload.php';
require_once __DIR__ .'/../app/config/app.php';

$app = new \MyStuff\Application([]);

$app['debug'] = true;

$app->run();
