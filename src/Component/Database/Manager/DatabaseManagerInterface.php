<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Manager;

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
     * Open connection by given name
     *
     * @param string $name
     * @param ConfigurationInterface $config
     * @return mixed
    */
    public function open(string $name, ConfigurationInterface $config): mixed;





    /**
     * Add all configuration
     *
     * @param ConfigurationInterface[] $configs
     *
     * @return $this
     */
    public function configurations(array $configs): static;







    /**
     * Add all connections
     *
     * @param ConnectionInterface[] $connections
     *
     * @return $this
     */
    public function connections(array $connections): static;








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
     * Determine if the given connection name closed.
     *
     * @param string $name
     *
     * @return bool
    */
    public function connected(string $name): bool;








    /**
     * Returns all configuration
     *
     * @return ConfigurationInterface[]
    */
    public function configs(): array;







    /**
     * Returns all connections
     *
     * @return ConnectionInterface[]
    */
    public function getConnections(): array;







    /**
     * Close manager
     *
     * @return void
    */
    public function close(): void;
}
