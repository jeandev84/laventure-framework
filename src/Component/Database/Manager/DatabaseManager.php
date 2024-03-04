<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;

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
     * @var string|null
    */
    protected ?string $connection;




    /**
     * @var ConnectionInterface[]
    */
    protected array $connections = [];




    /**
     * @var array
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
     * @inheritDoc
    */
    public function open(string $name, array $credentials): static
    {
        $this->setCurrent($name);
        $this->setConfiguration($name, $credentials);

        return $this;
    }




    /**
     * @param string $name
     * @param array $config
     * @return $this
    */
    public function setConfiguration(string $name, array $config): static
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
    public function connections(array $connections): static
    {
        foreach ($connections as $connection) {
            $this->setConnection($connection);
        }

        return $this;
    }





    /**
     * Add connection
     *
     * @param ConnectionInterface $connection
     *
     * @return $this
    */
    public function setConnection(ConnectionInterface $connection): static
    {
        $this->connections[$connection->getName()] = $connection;

        return $this;
    }





    /**
     * @param string $name
     * @return bool
    */
    public function hasConnection(string $name): bool
    {
        return isset($this->connections[$name]);
    }






    /**
     * @inheritDoc
    */
    public function configuration(string $name): ConfigurationInterface
    {
        if (empty($this->config[$name])) {
            $this->abortIf("empty params for connection ($name)");
        }

        return new Configuration($this->config[$name]);
    }







    /**
     * @inheritDoc
    */
    public function connection(string $name = null): ConnectionInterface
    {
        $name   = $name ?: $this->getCurrent();
        $config = $this->configuration($name);

        if (!$this->hasConnection($name)) {
            $this->abortIf("unavailable connection named '$name'");
        }

        return $this->connect($name, $config);
    }





    /**
     * @param string $name
     * @param ConfigurationInterface $config
     * @return ConnectionInterface
    */
    public function connect(string $name, ConfigurationInterface $config): ConnectionInterface
    {
        $this->connections[$name]->connect($config);

        if (! $this->connections[$name]->connected()) {
            $this->abortIf("no connection detected for '$name'.");
        }

        $this->setCurrent($name);

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
    public function configs(): array
    {
        return $this->config;
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
    public function close(): void
    {
        $this->config      = [];
        $this->connections = [];
        $this->connected   = [];
        $this->connection  = null;
    }




    /**
     * @param string $connection
     * @return void
    */
    public function setCurrent(string $connection): void
    {
        $this->connection = $connection;
    }





    /**
     * @return string|null
     */
    public function getCurrent(): ?string
    {
        return $this->connection;
    }




    /**
     * @param string $message
     * @return void
    */
    protected function abortIf(string $message): void
    {
        (function () use ($message) {
            throw new DatabaseManagerException($message, [], 500);
        })();
    }
}
