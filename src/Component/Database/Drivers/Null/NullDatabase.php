<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Null;

use Laventure\Component\Database\Backup\DatabaseBackupInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Null\NullConnection;
use Laventure\Component\Database\Database;
use Laventure\Component\Database\DatabaseInterface;

/**
 * NullDatabase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers
*/
class NullDatabase extends Database
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return '';
    }





    /**
     * @inheritDoc
    */
    public function create(): mixed
    {
        return false;
    }





    /**
     * @inheritDoc
    */
    public function drop(): mixed
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function getTables(): array
    {
        return [];
    }





    /**
     * @inheritDoc
    */
    public function exists(): bool
    {
        return false;
    }




    /**
     * @inheritDoc
    */
    public function list(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function createSchema(string $name): mixed
    {
        return '';
    }




    /**
     * @inheritDoc
    */
    public function dump(): DatabaseBackupInterface
    {
        // TODO: Implement dump() method.
    }
}
