<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Traits;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;

/**
 * ConnectionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Traits
 */
trait ConnectionTrait
{
    /**
     * @var ConfigurationInterface
     */
    protected $config;


    /**
     * @var mixed
    */
    protected mixed $connection;





    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    public function connect(ConfigurationInterface $config): static
    {
        $this->connectWithoutDatabase($config);

        if ($this->getDatabase()->exists()) {
            $this->connectIfExistsDatabase($config);
        }

        return $this;
    }






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
    public function configuration(): ConfigurationInterface
    {
        if (!$this->config) {
            $this->config = new NullConfiguration();
        }

        return $this->config;
    }





    /**
     * @return string
    */
    public function getDatabaseName(): string
    {
        return $this->config->getDatabase();
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





    /**
     * connect without database
     *
     * @param ConfigurationInterface $config
     * @return mixed
    */
    abstract public function connectWithoutDatabase(ConfigurationInterface $config): mixed;






    /**
     * PdoConnection to the database if exists
     *
     * @param ConfigurationInterface $config
     * @return $this
    */
    abstract public function connectIfExistsDatabase(ConfigurationInterface $config): mixed;
}
