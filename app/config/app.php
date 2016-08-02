<?php
declare(strict_types = 1);

require_once __DIR__ .'/../../vendor/autoload.php';

use Saxulum\DoctrineMongoDbOdm\Provider\DoctrineMongoDbOdmProvider;
use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;

use Silex\Application;

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new DoctrineMongoDbProvider, array(
    "mongodb.options" => array(
        "server" => "mongodb://localhost:27017",
        "options" => array(
            "username" => "homestead",
            "password" => "secret",
            "db" => "mystuff"
        ),
    ),
));

$app->register(new DoctrineMongoDbOdmProvider, array(
    "mongodbodm.dm.options" => array(
        "database" => "mystuff",
        "mappings" => array(
            // Using actual filesystem paths
            array(
                "type" => "annotation",
                "namespace" => "MyStuff",
                "path" => __DIR__."../src/MyStuff",
            )
        ),
    ),
));

Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::registerAnnotationClasses();

/*$app->get('/', function() use ($app) {
    $dm = $app['mongodbodm.dm'];

    $post = new \MyStuff\Entities\Posts();
    $post->setTitle('Meu segundo post');
    $post->setDescription('Adicionei meu segundo post');

    $dm->persist($post);

    $dm->flush();

    return "Ola mundo";
});*/

return $app;
