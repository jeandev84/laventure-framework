<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;


use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Builder\SQL\SqlBuilderFactory;
use Laventure\Component\Database\Builder\SQL\SQlBuilderInterface;
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

      const SELECT = 'select';
      const INSERT = 'insert';
      const UPDATE = 'update';
      const DELETE = 'delete';

      protected string $state = self::SELECT;
      protected ConnectionInterface $connection;
      protected SqlBuilderFactory $factory;
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
          $this->factory    = new SqlBuilderFactory($connection);
          $this->select     = $this->factory->createSelect();
          $this->insert     = $this->factory->createInsert();
          $this->update     = $this->factory->createUpdate();
          $this->delete     = $this->factory->createDelete();
          $this->expr       = $this->factory->createExpr();
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
      public function select(): SelectBuilderInterface
      {
          $this->state = self::SELECT;

          return $this->select;
      }





      /**
       * @return InsertBuilderInterface
      */
      public function insert(): InsertBuilderInterface
      {
          $this->state = self::INSERT;

          return $this->insert;
      }






      /**
       * @return UpdateBuilderInterface
      */
      public function update(): UpdateBuilderInterface
      {
          $this->state = self::UPDATE;

          return $this->update;
      }






      /**
       * @return DeleteBuilderInterface
      */
      public function delete(): DeleteBuilderInterface
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
       * @return SQlBuilderInterface
      */
      public function getSQLBuilder(): SQlBuilderInterface
      {
           return match ($this->state) {
               self::SELECT => $this->select,
               self::INSERT => $this->insert,
               self::UPDATE => $this->update,
               self::DELETE => $this->delete
           };
      }
}