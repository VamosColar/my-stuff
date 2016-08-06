<?php declare(strict_types = 1);

namespace MyStuff;

use MyStuff\Provider\ConfigProvider;
use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use Saxulum\DoctrineMongoDbOdm\Provider\DoctrineMongoDbOdmProvider;
use \Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use \Silex\Application as SilexApplication;

class Application extends SilexApplication
{

    public function __construct()
    {
        parent::__construct([]);

        $this->register(new DoctrineMongoDbProvider(), array(
            "mongodb.options" => array(
                "server" => "mongodb://localhost:27017",
                "options" => array(
                    "username" => "homestead",
                    "password" => "secret",
                    "db" => "mystuff"
                ),
            ),
        ));

        $this->register(new DoctrineMongoDbOdmProvider(), array(
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

        $this->register(new ConfigProvider());

        AnnotationDriver::registerAnnotationClasses();

        $this['db'] = $this['mongodbodm.dm'];

    }

    public function rootPath()
    {
        return __DIR__ .'../';
    }

}



