<?php

declare(strict_types=1);

namespace Laventure\Component\Database;

use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * DatabaseInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers
*/
interface DatabaseInterface
{
    /**
     * Returns name of database
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Returns connection
     *
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;








    /**
     * Returns table names of database
     *
     * @return array
    */
    public function getTables(): array;







    /**
     * Create database
     *
     * @return mixed
    */
    public function create(): mixed;







    /**
     * Create schema by given name
     *
     * @param string $name
     * @return mixed
    */
    public function createSchema(string $name): mixed;






    /**
     * Drop database
     *
     * @return mixed
    */
    public function drop(): mixed;







    /**
     * Full back up of an existing SQL database
     *
     * @param string $filepath
     * @return mixed
    */
    public function dump(string $filepath): mixed;








    /**
     * Back up only the parts of the database
     * that have changed since the last full database backup
     *
     * @param string $filepath
     * @return mixed
    */
    public function dumpDiff(string $filepath): mixed;









    /**
     * Determine if database exists
     *
     * @return bool
    */
    public function exists(): bool;









    /**
     * List all databases
     *
     * @return array
    */
    public function list(): array;
}
