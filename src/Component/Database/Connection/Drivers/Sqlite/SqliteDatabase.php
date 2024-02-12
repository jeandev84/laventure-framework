<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Sqlite;

use Laventure\Component\Database\Database;

/**
 * SqliteDatabase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Sqlite
 */
class SqliteDatabase extends Database
{
    /**
     * @inheritDoc
    */
    public function create(): mixed
    {

    }



    /**
     * @inheritDoc
     */
    public function drop(): mixed
    {
        // TODO: Implement drop() method.
    }

    /**
     * @inheritDoc
     */
    public function getSchemas(): array
    {
        // TODO: Implement getSchemas() method.
    }
}
