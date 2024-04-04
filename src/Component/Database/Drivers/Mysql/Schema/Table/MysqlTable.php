<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Drivers\Mysql\Schema\Table\Column\MysqlColumnFactory;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Factory\ColumnFactoryInterface;
use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Table\Builder\TableSQlBuilderInterface;
use Laventure\Component\Database\Schema\Table\Exception\TableException;
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
     * @return array
    */
    public function getColumnsFromTable(): array
    {
        if (!$this->exists()) {
            return [];
        }

        return $this->statement(
            sprintf('SHOW FULL COLUMNS FROM %s;', $this->name)
        )->fetch()->all();
    }





    /**
     * @param array $data
     * @return ColumnInterface
    */
    public function columnFromArray(array $data): ColumnInterface
    {
        return $this->getColumnFactory()->createFromParameter($this->param($data));
    }




    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {
        foreach ($this->getColumnsFromTable() as $data) {
            $column = $this->columnFromArray($data);
            $this->criteria->columns[$column->getName()] = $column;
        }

        return $this->criteria->columns;
    }







    /**
     * @param $type
     * @return array
    */
    public function fetchConstraintsByType($type): array
    {
        $constraintColumn = $this->getConstraintTable(".CONSTRAINT_TYPE");

        return $this->findConstraintsBy([
            $constraintColumn => $type
        ]);
    }




    /**
     * @param array $criteria
     * @return array
    */
    public function findConstraintsBy(array $criteria = []): array
    {
        $qb               = $this->connection->createQueryBuilder();
        $schemaColumn     = $this->getConstraintTable(".TABLE_SCHEMA");
        $tableColumn      = $this->getConstraintTable(".TABLE_NAME");

        $criteria = array_merge([
            $schemaColumn => $this->getSchemaName(),
            $tableColumn  => $this->getName(),
        ], $criteria);


        return $qb->select()
                  ->from($this->getConstraintTable())
                  ->criteria($criteria)
                  ->getQuery()
                  ->fetch()
                  ->all();
    }




    /**
     * @param array $data
     * @return ConstraintInterface
    */
    public function constraintFromArray(array $data): ConstraintInterface
    {
        $param = $this->param($data);
        $type  = $param->replace('CONSTRAINT_TYPE', ' ', '_');
        $name  = $param->string('CONSTRAINT_NAME');

        return (new Constraint($type, $name))
               ->options($param->all());
    }




    /**
     * @inheritDoc
    */
    public function getConstraints(): array
    {
        foreach ($this->findConstraintsBy() as $data) {
            $constraint = $this->constraintFromArray($data);
            $this->criteria->constraint[$constraint->getName()] = $constraint;
        }

        return $this->criteria->constraint;
    }






    /**
     * @param string $type
     * @return array
    */
    public function getConstraintsBy(string $type): array
    {
        $func = function (ConstraintInterface $constraint) use ($type) {
            return ($constraint->getType() === $type);
        };

        return array_filter($this->getConstraints(), $func);
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
        return $this->getConstraintsBy("PRIMARY_KEY");
    }





    /**
     * @inheritDoc
    */
    public function getPrimaryKey(string $primaryKey): PrimaryKeyInterface
    {
        if (!$this->hasPrimaryKey($primaryKey)) {
            throw new TableException("Unavailable primary key '$primaryKey'");
        }

        return $this->getPrimaryKeys()[$primaryKey];
    }






    /**
     * @inheritDoc
    */
    public function getForeignKey(string $foreignKey): ForeignKeyInterface
    {
        if (!$this->hasForeignKey($foreignKey)) {
            throw new TableException("Unavailable foreign key '$foreignKey'");
        }

        return $this->getForeignKeys()[$foreignKey];
    }






    /**
     * @inheritDoc
    */
    public function getForeignKeys(): array
    {
        return $this->getConstraintsBy("FOREIGN_KEY");
    }







    /**
     * @inheritDoc
    */
    public function dropForeignKey(string $foreignKey): static
    {
        if ($this->hasForeignKey($foreignKey)) {
            $this->exec(
                sprintf('ALTER TABLE `%s` DROP FOREIGN KEY `%s`', $this->getName(), $foreignKey)
            );
            $this->dropIndex($foreignKey);
        }

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function dropForeignKeys(): static
    {
        foreach ($this->getForeignKeys() as $foreignKey) {
            $this->dropForeignKey($foreignKey->getName());
        }

        return $this;
    }





    /**
     * @param callable $func
     * @return $this
    */
    public function checkForeignKeys(callable $func): mixed
    {
        $this->exec("SET foreign_key_checks = 0;");
        $result = $func($this);
        $this->exec("SET foreign_key_checks = 1;");
        return $result;
    }




    /**
     * @inheritDoc
    */
    public function drop(): bool|int
    {
        return $this->checkForeignKeys(function () {
            return $this->exec(
                sprintf('DROP TABLE IF EXISTS %s CASCADE;', $this->getName())
            );
        });
    }







    /**
     * @inheritDoc
    */
    public function hasIndex(string $index): bool
    {
        return array_key_exists($index, $this->getIndexes());
    }






    /**
     * @inheritDoc
    */
    public function getIndex(string $index): IndexInterface
    {
        if (!$this->hasIndex($index)) {
            throw new TableException("Unavailable index '$index'");
        }

        return $this->getIndexes()[$index];
    }





    /**
     * @return IndexInterface[]
     * @inheritDoc
    */
    public function getIndexes(): array
    {
        return $this->getConstraints();
    }





    /**
     * @inheritDoc
    */
    public function dropIndexes(): static
    {
        foreach ($this->getIndexes() as $index) {
            $this->dropIndex($index->getName());
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function dropIndex(string $index): static
    {
        if ($this->hasIndex($index)) {
            $this->exec(
                sprintf('ALTER TABLE %s DROP INDEX %s', $this->getName(), $index)
            );
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getUniqueKey(string $uniqueKey): UniqueKeyInterface
    {
        if (!$this->hasUniqueKey($uniqueKey)) {
            throw new TableException("Unavailable unique key '$uniqueKey'");
        }

        return $this->getUniqueKeys()[$uniqueKey];
    }







    /**
     * @inheritDoc
    */
    public function getUniqueKeys(): array
    {
        return $this->getConstraintsBy("UNIQUE");
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
    private function getConstraintTable(string $column = ''): string
    {
        return sprintf('information_schema.table_constraints%s', $column);
    }
}
