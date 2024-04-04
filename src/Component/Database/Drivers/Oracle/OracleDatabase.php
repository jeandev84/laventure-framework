<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Oracle;

use Laventure\Component\Database\Database;

/**
 * OracleDatabase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Oracle
 */
class OracleDatabase extends Database
{
    /**
     * @inheritDoc
     */
    public function create(): mixed
    {
        // TODO: Implement create() method.
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
    public function getTables(): array
    {
        // TODO: Implement getSchemas() method.
    }

    /**
     * @inheritDoc
     */
    public function list(): array
    {
        // TODO: Implement list() method.
    }

    /**
     * @inheritDoc
     */
    public function createSchema(string $name): mixed
    {
        // TODO: Implement createSchema() method.
    }
}
