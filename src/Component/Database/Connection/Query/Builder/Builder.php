<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder;

use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Builder\SQL\SQLBuilderFactory;
use Laventure\Component\Database\Builder\SQL\SQLBuilderInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * Builder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
*/
class Builder
{
    public const SELECT = 'select';
    public const INSERT = 'insert';
    public const UPDATE = 'update';
    public const DELETE = 'delete';

    protected string $state = self::SELECT;
    protected ConnectionInterface $connection;
    protected SQLBuilderFactory $factory;
    protected SelectBuilderInterface $select;
    protected InsertBuilderInterface $insert;
    protected UpdateBuilderInterface $update;
    protected DeleteBuilderInterface $delete;
    protected ExpressionInterface $expr;




    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->factory    = new SQLBuilderFactory($connection);
        $this->select     = $this->factory->createSelectBuilder();
        $this->insert     = $this->factory->createInsertBuilder();
        $this->update     = $this->factory->createUpdateBuilder();
        $this->delete     = $this->factory->createDeleteBuilder();
        $this->expr       = $this->factory->expr();
        $this->connection = $connection;
    }




    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface
    {
        return $this->expr;
    }




    /**
     * @return SelectBuilderInterface
    */
    public function selectQuery(): SelectBuilderInterface
    {
        $this->state = self::SELECT;

        return $this->select;
    }





    /**
     * @return InsertBuilderInterface
    */
    public function insertQuery(): InsertBuilderInterface
    {
        $this->state = self::INSERT;

        return $this->insert;
    }






    /**
     * @return UpdateBuilderInterface
    */
    public function updateQuery(): UpdateBuilderInterface
    {
        $this->state = self::UPDATE;

        return $this->update;
    }






    /**
     * @return DeleteBuilderInterface
    */
    public function deleteQuery(): DeleteBuilderInterface
    {
        $this->state = self::DELETE;

        return $this->delete;
    }






    /**
     * @return string
    */
    public function getState(): string
    {
        return $this->state;
    }





    /**
     * @return SQLBuilderInterface
    */
    public function getSQLBuilder(): SQLBuilderInterface
    {
        return match ($this->state) {
            self::SELECT => $this->select,
            self::INSERT => $this->insert,
            self::UPDATE => $this->update,
            self::DELETE => $this->delete
        };
    }
}
