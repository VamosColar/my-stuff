<?php
declare(strict_types = 1);

namespace MyStuff\Domain\Entitie;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use MyStuff\Application;

/** @ODM\Document(collection="posts") */
class Posts
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $title;

    /** @ODM\Field(type="string") */
    private $description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function setTitle($title)
    {
        $app = new Application([]);
        // var_dump($app);exit;
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
