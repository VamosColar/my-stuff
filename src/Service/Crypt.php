<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 06/08/16
 * Time: 22:11
 */

namespace MyStuff\Service;

use MyStuff\Application;

class Crypt
{

    protected $cust = '08';

    protected $secret;

    protected $methodHash = '2a';

    protected $saltLength = 20;

    public function __construct(Application $app)
    {
        $config = $app['config'];

        $this->secret = $config->get('app.secret_key');
    }

    public function hash(string $string) : string
    {
        if (empty($string)) {
            throw new \InvalidArgumentException('Valor passado esta vazio');
        }

        return crypt($string, self::generatorStringHash());

    }

    public function check(string $string, string $hash) : bool
    {
        return (self::hash($string) === $hash);
    }


    private function generatorStringHash() : string
    {
        return sprintf('$%s$%02d$%s$', $this->methodHash, $this->cust, $this->generateRandomSecret());
    }

    private function generateRandomSecret() : string
    {
        $seed = uniqid((string)mt_rand(), true);

        $salt = base64_encode($seed);
        $salt = str_replace('+', '.', $salt);

        return substr($this->secret . $salt, 0, $this->saltLength);
    }


}