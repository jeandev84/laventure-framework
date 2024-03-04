<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\Null;

use Laventure\Component\Database\Connection\Null\NullConnection;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Insert\Null\NullInsertBuilder;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Update\Null\NullUpdateBuilder;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DQL\Select\Null\NullSelectBuilder;
use Laventure\Component\Database\Connection\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQLQueryBuilderInterface;

/**
 * NullQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder
*/
class NullQueryBuilder implements SQLQueryBuilderInterface
{

    protected NullConnection $connection;


    public function __construct()
    {
        $this->connection = new NullConnection();
    }




    /**
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        throw new \RuntimeException("Could not found expression for null query builder.");
    }



    /**
     * @inheritDoc
    */
    public function select(string $selects = null): SelectBuilderInterface
    {
        return new NullSelectBuilder($this->connection);
    }



    /**
     * @inheritDoc
    */
    public function insert(string $table): InsertBuilderInterface
    {
         return new NullInsertBuilder($this->connection);
    }




    /**
     * @inheritDoc
    */
    public function update(string $table): UpdateBuilderInterface
    {
       return new NullUpdateBuilder($this->connection);
    }



    /**
     * @inheritDoc
    */
    public function delete(string $table): DeleteBuilderInterface
    {

    }
}
