<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Contract;

/**
 * EnvironmentInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Writer
 */
interface EnvironmentInterface
{
    /**
     * Put some environment
     *
     * @param string $env
     * @return mixed
    */
    public function put(string $env): mixed;




    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;




    /**
     * Remove some index
     *
     * @param string $key
     * @return void
    */
    public function remove(string $key): void;





    /**
     * Clear all environments
     *
     * @return void
    */
    public function clear(): void;




    /**
     * @return bool
     */
    public function empty(): bool;




    /**
     * Returns all environments data
     *
     * @return array
    */
    public function all(): array;
}
