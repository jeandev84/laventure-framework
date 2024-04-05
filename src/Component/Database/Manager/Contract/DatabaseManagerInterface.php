<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Contract;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * DatabaseManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager
 */
interface DatabaseManagerInterface
{
    /**
     * Set connection name
     *
     * @param string $connection
     * @return $this
     */
    public function setName(string $connection): static;







    /**
     * Returns current connection name
     *
     * @return string
     */
    public function getName(): string;







    /**
     * @param string $name
     * @param ConfigurationInterface $config
     * @return $this
     */
    public function setConfiguration(string $name, ConfigurationInterface $config): static;






    /**
     * Add all configuration
     *
     * @param ConfigurationInterface[] $configs
     *
     * @return $this
    */
    public function configurations(array $configs): static;








    /**
     * Determine if exists configuration by given name
     *
     * @param string $name
     * @return bool
    */
    public function hasConfiguration(string $name): bool;








    /**
     * Returns all configuration
     *
     * @return ConfigurationInterface[]
    */
    public function getConfigurations(): array;








    /**
     * set connection
     *
     * @param ConnectionInterface $connection
     *
     * @return $this
    */
    public function setConnection(ConnectionInterface $connection): static;








    /**
     * Add all connections
     *
     * @param ConnectionInterface[] $connections
     *
     * @return $this
    */
    public function connections(array $connections): static;








    /**
     * Determine if exists connection by given name
     *
     * @param string $name
     * @return bool
    */
    public function hasConnection(string $name): bool;











    /**
     * Returns all connections
     *
     * @return ConnectionInterface[]
    */
    public function getConnections(): array;








    /**
     * Open connection by given name
     *
     * @param string $name
     * @param ConfigurationInterface $config
     * @return mixed
    */
    public function open(string $name, ConfigurationInterface $config): mixed;










    /**
     * @param string $name
     *
     * @return ConfigurationInterface
    */
    public function configuration(string $name): ConfigurationInterface;







    /**
     * @param string|null $name
     *
     * @return ConnectionInterface
    */
    public function connection(string $name = null): ConnectionInterface;








    /**
     * Connect to database
     *
     * @param string $name
     * @param ConfigurationInterface $config
     * @return ConnectionInterface
    */
    public function connect(string $name, ConfigurationInterface $config): ConnectionInterface;









    /**
     * Determine if the given connection name closed.
     *
     * @param string $name
     *
     * @return bool
    */
    public function connected(string $name): bool;









    /**
     * Close manager
     *
     * @return void
    */
    public function close(): void;
}
