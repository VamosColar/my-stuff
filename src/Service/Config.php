<?php declare(strict_types = 1);

namespace MyStuff\Service;

use MyStuff\Exception\FileConfigException;

/**
 * Load configuration file
 *
 * Class Config
 * @package MyStuff\Config
 * @author edyonil <edyonil@gmail.com>
 */
class Config
{
    /**
     * @var string Directory name where the configuration file
     */
    private $directory;

    /**
     * Config constructor.
     * @param string $directory
     */
    public function __construct(string $directory)
    {

        $this->directory = $directory;
    }

    /**
     * @param string $file
     * @return mixed
     * @throws FileConfigException
     */
    public function get(string $file)
    {

        $path = explode('.', $file);

        if (!$this->existFile($path[0])) {
            throw new FileConfigException("Arquivo de configuração não foi encontrado no diretório {$this->getFilePath($path[0])}");
        }

        return $this->loadConfig($path);

    }

    /**
     * @param string $file
     * @return string
     */
    private function getFilePath(string $file) : string
    {
        return $this->directory . '/' . $file . '.php';
    }

    /**
     * @param string $file
     * @return bool
     */
    private function existFile(string $file) : bool
    {
        return is_file($this->getFilePath($file));
    }

    /**
     * @param array $path
     * @return mixed
     * @throws FileConfigException
     */
    private function loadConfig(array $path)
    {

        $file = require($this->getFilePath($path[0]));

        if (count($path) === 1) {
            return $file;
        }

        if (!array_key_exists($path[1], $file)) {

            throw new FileConfigException();

        };

        $cursor = $file[$path[1]];

        for ($i = 2; $i < count($path); $i++) {

            if (is_array($cursor)) {

                if (!array_key_exists($path[$i], $cursor)) {

                    throw new FileConfigException();

                } else {

                    $cursor = $cursor[$path[$i]];
                }

            } else {
                break;
            }

        }

        return $cursor;

    }
}