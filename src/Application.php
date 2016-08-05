<?php
declare(strict_types = 1);

namespace MyStuff;

use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use Saxulum\DoctrineMongoDbOdm\Provider\DoctrineMongoDbOdmProvider;
use \Silex\Application as SilexApplication;

class Application extends SilexApplication
{
    public function __construct(array $values)
    {
        parent::__construct($values);

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

        $this['db'] = $this['mongodbodm.dm'];
    }
}
