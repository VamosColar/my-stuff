<?php
declare(strict_types = 1);

require_once __DIR__ .'/../vendor/autoload.php';

$app = new \MyStuff\Application([]);

$app['debug'] = true;

Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::registerAnnotationClasses();

$app->get('/', function() use ($app) {


    $post = new \MyStuff\Domain\Entitie\Posts();
    $post->setTitle('Meu segundo post');
    $post->setDescription('Adicionei meu segundo post');

    $app['db']->persist($post);

    $app['db']->flush();

    return "Ola mundo";
});

$app->run();
