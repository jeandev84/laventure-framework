<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Exception\ConfigurationException;
use Laventure\Component\Database\Configuration\Exception\NotFoundConfigurationException;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Exception\NotFoundConnectionException;
use Laventure\Component\Database\Connection\Exception\UnavailableConnectionException;
use Laventure\Component\Database\Manager\Contract\DatabaseManagerInterface;
use Laventure\Component\Database\Manager\Exception\DatabaseManagerException;

/**
 * DatabaseManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager
*/
class DatabaseManager implements DatabaseManagerInterface
{
    /**
     * Default connection driver
     *
     * @var string
    */
    protected string $connection = '';




    /**
     * @var ConnectionInterface[]
    */
    protected array $connections = [];




    /**
     * @var ConfigurationInterface[]
    */
    protected array $config = [];





    /**
     * @var ConnectionInterface[]
    */
    protected array $connected = [];




    /**
     * @param ConnectionInterface[] $connections
    */
    public function __construct(array $connections = [])
    {
        $this->connections($connections);
    }





    /**
     * @inheritdoc
    */
    public function setName(string $connection): static
    {
        $this->connection = $connection;

        return $this;
    }







    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return $this->connection;
    }







    /**
     * @inheritdoc
    */
    public function setConfiguration(string $name, ConfigurationInterface $config): static
    {
        $this->config[$name] = $config;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function configurations(array $configs): static
    {
        foreach ($configs as $name => $config) {
            $this->setConfiguration($name, $config);
        }

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function hasConfiguration(string $name): bool
    {
        return isset($this->config[$name]);
    }








    /**
     * @inheritDoc
    */
    public function getConfigurations(): array
    {
        return $this->config;
    }








    /**
     * @inheritDoc
    */
    public function connections(array $connections): static
    {
        foreach ($connections as $connection) {
            $this->setConnection($connection);
        }

        return $this;
    }







    /**
     * @inheritdoc
    */
    public function setConnection(ConnectionInterface $connection): static
    {
        $this->connections[$connection->getName()] = $connection;

        return $this;
    }







    /**
     * @inheritdoc
    */
    public function hasConnection(string $name): bool
    {
        return isset($this->connections[$name]);
    }







    /**
     * @inheritDoc
    */
    public function getConnections(): array
    {
        return $this->connections;
    }







    /**
     * @inheritDoc
    */
    public function open(string $name, ConfigurationInterface $config): static
    {
        return $this->setName($name)->setConfiguration($name, $config);
    }





    /**
     * @inheritDoc
     * @throws NotFoundConfigurationException
    */
    public function configuration(string $name): ConfigurationInterface
    {
        if (!$this->hasConfiguration($name)) {
            throw new NotFoundConfigurationException(
                ['context' => "Not found for connection named '$name'"]
            );
        }

        return $this->config[$name];
    }





    /**
     * @inheritDoc
     * @param string|null $name
     * @return ConnectionInterface
     * @throws NotFoundConfigurationException
     * @throws NotFoundConnectionException
     * @throws UnavailableConnectionException
    */
    public function connection(string $name = null): ConnectionInterface
    {
        $name   = $name ?: $this->getName();
        $config = $this->configuration($name);

        if (!$this->hasConnection($name)) {
            throw new NotFoundConnectionException($name);
        }

        return $this->connect($name, $config);
    }





    /**
     * @inheritdoc
     * @throws UnavailableConnectionException
    */
    public function connect(string $name, ConfigurationInterface $config): ConnectionInterface
    {
        $this->connections[$name]->parse($config)->connect();

        if (! $this->connections[$name]->connected()) {
            throw new UnavailableConnectionException($name);
        }

        $this->setName($name);

        return $this->connected[$name] = $this->connections[$name];
    }







    /**
     * @inheritDoc
    */
    public function connected(string $name): bool
    {
        return isset($this->connected[$name]);
    }








    /**
     * @inheritDoc
    */
    public function close(): void
    {
        $this->config      = [];
        $this->connections = [];
        $this->connected   = [];
        $this->connection  = '';
    }
}
