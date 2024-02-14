<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\ConnectionStack;
use Laventure\Component\Database\DatabaseException;

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




    public function __construct()
    {
        $this->connections(ConnectionStack::getDefaults());
    }





    /**
     * @inheritDoc
    */
    public function open(string $name, array $credentials): static
    {
        $this->setCurrentConnection($name);
        $this->setConfiguration($name, $credentials);

        return $this;
    }





    /**
     * @param string $connection
     * @return void
    */
    public function setCurrentConnection(string $connection): void
    {
        $this->connection = $connection;
    }





    /**
     * @return string|null
    */
    public function getCurrentConnection(): ?string
    {
        return $this->connection;
    }





    /**
     * @param string $name
     * @param array $credentials
     * @return $this
    */
    public function setConfiguration(string $name, array $credentials): static
    {
        $this->config[$name] = $credentials;

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
    public function configuration(string $name): mixed
    {
        if (empty($this->config[$name])) {
            $this->abortIf("Empty params for connection ($name)");
        }

        return $this->config[$name];
    }




    /**
     * @inheritDoc
    */
    public function connection(string $name = ''): ConnectionInterface
    {
        $name        = $name ?: $this->getCurrentConnection();
        $credentials = $this->configuration($name);

        if (!$this->hasConnection($name)) {
            $this->abortIf("unavailable connection named '$name'");
        }

        return $this->connect($name, $credentials);
    }





    /**
     * @param string $name
     * @param array $credentials
     * @return ConnectionInterface
    */
    public function connect(string $name, array $credentials): ConnectionInterface
    {
        $this->connections[$name]->connect(new Configuration($credentials));

        if (! $this->connections[$name]->connected()) {
            $this->abortIf("no connection detected for '$name'.");
        }

        $this->setCurrentConnection($name);

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
    public function configs(): mixed
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
