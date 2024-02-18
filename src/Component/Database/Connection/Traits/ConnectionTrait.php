<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Traits;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\NullConfiguration;

/**
 * ConnectionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Traits
 */
trait ConnectionTrait
{
    /**
     * @var ConfigurationInterface
     */
    protected ConfigurationInterface $config;


    /**
     * @var mixed
    */
    protected mixed $connection;




    /**
     * @param mixed $connection
     *
     * @return $this
    */
    public function withConnection(mixed $connection): static
    {
        $this->connection = $connection;

        return $this;
    }




    /**
     * @return mixed
    */
    public function getConnection(): mixed
    {
        return $this->connection;
    }




    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    public function withConfiguration(ConfigurationInterface $config): static
    {
        $this->config = $config;

        return $this;
    }





    /**
     * @return ConfigurationInterface
    */
    public function getConfiguration(): ConfigurationInterface
    {
        return $this->config;
    }





    /**
     * @return string
    */
    public function getDatabaseName(): string
    {
        return $this->config->database();
    }





    /**
     * @param $key
     * @param $default
     * @return mixed
    */
    public function config($key, $default = null): mixed
    {
        return $this->config->get($key, $default);
    }
}
