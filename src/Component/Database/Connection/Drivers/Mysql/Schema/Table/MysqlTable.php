<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table\Column\MysqlColumnFactory;
use Laventure\Component\Database\Query\Result\QueryResultInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Factory\ColumnFactoryInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Table\Builder\TableSQlBuilderInterface;
use Laventure\Component\Database\Schema\Table\Table;

/**
 * MysqlTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql\Schema\Table
*/
class MysqlTable extends Table
{

    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(ConnectionInterface $connection, string $name)
    {
        parent::__construct($connection, $name);
    }





    /**
     * @return QueryResultInterface
    */
    public function fetchColumnsQuery(): QueryResultInterface
    {
        return $this->statement(
            sprintf('SHOW FULL COLUMNS FROM %s;', $this->name)
        )->fetch();
    }





    /**
     * @param array $data
     * @return ColumnInterface
    */
    public function columnFromArray(array $data): ColumnInterface
    {
         return $this->getColumnFactory()
                     ->createFromParameter($this->param($data));
    }




    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {
        foreach ($this->fetchColumnsQuery()->all() as $data) {
            $column = $this->columnFromArray($data);
            $this->criteria->columns[$column->getName()] = $column;
        }

        return $this->criteria->columns;
    }





    /**
     * @param $type
     * @return array
    */
    public function fetchConstraintsBy($type = null): array
    {
        $qb       = $this->connection->createQueryBuilder();
        $criteria = $this->constraintCriteriaBy($type);

        return $qb->select()
                  ->from($this->constraintTable())
                  ->criteria($criteria)
                  ->getQuery()
                  ->fetch()
                  ->all();
    }




    /**
     * @inheritDoc
    */
    public function getConstraints(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function dropPrimaryKey(string $primaryKey): static
    {
        return $this;
    }






    /**
     * @inheritDoc
    */
    public function dropPrimaryKeys(): static
    {
        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getPrimaryKeys(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function getPrimaryKey(string $primaryKey): PrimaryKeyInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function getForeignKey(string $foreignKey): ForeignKeyInterface
    {

    }






    /**
     * @inheritDoc
    */
    public function getForeignKeys(): array
    {

    }




    /**
     * @inheritDoc
    */
    public function dropForeignKey(string $foreignKey): static
    {
        if ($this->hasForeignKey($foreignKey)) {
            $this->exec(
                sprintf('ALTER TABLE %s DROP FOREIGN KEY %s', $this->getName(), $foreignKey)
            );
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function dropForeignKeys(): static
    {
        foreach ($this->getForeignKeys() as $foreignKey){
            $this->dropForeignKey($foreignKey->getKey());
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function hasIndex(string $index): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getIndex(string $index): IndexInterface
    {

    }





    /**
     * @inheritDoc
    */
    public function getIndexes(): array
    {

    }





    /**
     * @inheritDoc
    */
    public function getUniqueKey(string $uniqueKey): UniqueKeyInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function getUniqueKeys(): array
    {
        return [];
    }






    /**
     * @inheritDoc
    */
    public function dump(): mixed
    {

    }





    /**
     * @inheritDoc
    */
    public function expr(): TableSQlBuilderInterface
    {
        return new MysqlTableSQLBuilder($this);
    }





    /**
     * @inheritDoc
    */
    public function getColumnFactory(): ColumnFactoryInterface
    {
        return new MysqlColumnFactory();
    }





    /**
     * @param string $column
     * @return string
    */
    private function constraintTable(string $column = ''): string
    {
        return sprintf('information_schema.table_constraints%s', $column);
    }





    /**
     * @param $type
     * @return array
    */
    private function constraintCriteriaBy($type = null): array
    {
        $schemaColumn         = $this->constraintTable(".TABLE_SCHEMA");
        $tableColumn          = $this->constraintTable(".TABLE_NAME");
        $constraintTypeColumn = $this->constraintTable(".CONSTRAINT_TYPE");

        $criteria = [
            $schemaColumn => $this->getSchemaName(),
            $tableColumn  => $this->getName(),
        ];

        if ($type) {
            $criteria[$constraintTypeColumn] = $type;
        }

        return $criteria;
    }
}
