<?php
declare(strict_types = 1);

require_once __DIR__ .'/../vendor/autoload.php';


$app = new \MyStuff\Application([]);

$app['debug'] = true;

$app->run();
