<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\SqlServer;

use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;

/**
 * SqlServerQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\SqlServer
*/
class SqlServerQueryBuilder implements SQLQueryBuilderInterface
{
    /**
     * @inheritDoc
    */
    public function expr(): ExpressionBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {

    }
}
