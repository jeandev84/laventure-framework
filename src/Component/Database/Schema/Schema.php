<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema;

use Closure;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * Schema
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema
*/
class Schema implements SchemaInterface
{


    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(
        protected ConnectionInterface $connection
    )
    {
    }






    /**
     * @inheritDoc
    */
    public function create(string $table, Closure $closure): mixed
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function update(string $table, Closure $closure): mixed
    {
        return false;
    }






    /**
     * @inheritDoc
    */
    public function drop(string $table): mixed
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function dropIfExists(string $table): mixed
    {
        return false;
    }






    /**
     * @inheritDoc
    */
    public function truncate(string $table): mixed
    {
        return false;
    }






    /**
     * @inheritDoc
    */
    public function truncateCascade(string $table): mixed
    {
        return false;
    }







    /**
     * @inheritDoc
    */
    public function getColumns(string $table): array
    {
        return [];
    }







    /**
     * @inheritDoc
    */
    public function exists(string $table): bool
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function hasColumn(string $table, string $column): bool
    {
         return false;
    }





    /**
     * @inheritDoc
    */
    public function exec(string $sql): static
    {
        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getTables(): array
    {
        return [];
    }
}