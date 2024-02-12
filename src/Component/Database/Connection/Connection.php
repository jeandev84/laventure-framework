<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection;


use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\NullConfiguration;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * Connection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection
 */
abstract class Connection implements ConnectionInterface
{

    /**
     * @var ConfigurationInterface
    */
    protected ConfigurationInterface $config;


    /**
     * @var mixed
    */
    protected mixed $connection;



    public function __construct()
    {
        $this->config  = new NullConfiguration();
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
     * @inheritDoc
    */
    public function getConfiguration(): ConfigurationInterface
    {
        return $this->config;
    }




    /**
     * @inheritDoc
    */
    public function config($key, $default = null): mixed
    {
        return $this->config->get($key, $default);
    }
}