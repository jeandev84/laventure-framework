<?php
declare(strict_types=1);

namespace Laventure\Component\Database;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\NullConnection;

/**
 * NullDatabase
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database
*/
class NullDatabase implements DatabaseInterface
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
    public function getConnection(): ConnectionInterface
    {
        return new NullConnection();
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
}