<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new \Lalbert\Silex\Provider\MongoDBServiceProvider(), [
    'mongodb.config' => [
        'server' => 'mongodb://homestead:secret@localhost:27017',
        'options' => [],
        'driverOptions' => [],
    ]
]);

$document = ['key' => 'value'];

$app['mongodb']
    ->mydatabase
    ->mycollection
    ->insert($document)
;

$app->get('/', function () {
    phpinfo();
});

$app->run();
