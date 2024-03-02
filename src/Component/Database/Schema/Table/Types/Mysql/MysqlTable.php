<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Types\Mysql;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Query\Result\QueryResultInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Types\Mysql\MysqlColumnFactory;
use Laventure\Component\Database\Schema\Column\Types\Mysql\MysqlColumnInfo;
use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\Info\ConstraintInfo;
use Laventure\Component\Database\Schema\Constraints\Types\Index;
use Laventure\Component\Database\Schema\Table\Table;

/**
 * MysqlTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Types\Mysql
 *
 * @see https://www.w3schools.com/sql/sql_datatypes.asp
 * @see https://www.w3schools.com/sql/sql_ref_mysql.asp
 * @see https://metanit.com/sql/mysql/2.3.php
*/
class MysqlTable extends Table
{
    /**
     * @var MysqlColumnFactory
    */
    protected MysqlColumnFactory $columnFactory;


    /**
     * @param ConnectionInterface $connection
     * @param string $name
     * @param string $schemaName
    */
    public function __construct(
        ConnectionInterface $connection,
        string $name,
        string $schemaName = ''
    ) {
        parent::__construct($connection, $name, $schemaName);
        $this->columnFactory = new MysqlColumnFactory();
    }




    /**
     * @inheritDoc
    */
    public function column(
        string $name,
        string $type = '',
        string $constraints = ''
    ): ColumnInterface {
        return $this->columnFactory->createColumn("`$name`", $type, $constraints);
    }






    /**
     * @inheritDoc
    */
    public function create(): bool
    {
        $sql = sprintf(
            'CREATE TABLE IF NOT EXISTS `%s` (%s);',
            $this->name,
            $this->getCriteria()->create()
        );

        $this->exec($sql);

        return $this->exists();
    }







    /**
     * @inheritDoc
    */
    public function increments(string $name): static
    {
        $this->bigIncrements($name)->primary();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function bigIncrements(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'BIGINT')
                   ->increment();
    }




    /**
     * @inheritDoc
    */
    public function integer(string $name, int $length = 11): ColumnInterface
    {
        return $this->addColumn($name, "INT($length)");
    }



    /**
     * @inheritDoc
    */
    public function smallInteger(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'SMALLINT');
    }





    /**
     * @inheritDoc
    */
    public function bigInteger(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'BIGINT');
    }





    /**
     * @inheritDoc
    */
    public function mediumInteger(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'MEDIUMINT');
    }






    /**
     * from -128 to 127 bytes
     *
     * @inheritDoc
    */
    public function tinyInteger(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'TINYINT');
    }






    /**
     * Support length to 4 гб
     *
     * @inheritDoc
     */
    public function longText(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'LONGTEXT');
    }




    /**
     * Support length to 16 гб
     *
     * @inheritDoc
    */
    public function mediumText(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'MEDIUMTEXT');
    }




    /**
     * @inheritDoc
    */
    public function tinyText(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'TINYTEXT');
    }




    /**
     * @inheritDoc
    */
    public function char(string $name, $value): ColumnInterface
    {
        return $this->addColumn($name, "CHAR($value)");
    }





    /**
     * @inheritDoc
    */
    public function date(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'DATE');
    }




    /**
     * @inheritDoc
    */
    public function time(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'TIME');
    }




    /**
     * @inheritDoc
    */
    public function datetime(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'DATETIME');
    }






    /**
     * @inheritDoc
    */
    public function timestamp(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'TIMESTAMP');
    }




    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function year(string $name): ColumnInterface
    {
        return $this->addColumn($name, "YEAR");
    }






    /**
     * @inheritDoc
    */
    public function binary(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'BINARY');
    }





    /**
     * to 4 bytes
     *
     * @inheritDoc
    */
    public function float(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'FLOAT');
    }






    /**
     * @inheritDoc
    */
    public function decimal(string $name, int $precision, int $scale): ColumnInterface
    {
        return $this->addColumn($name, "DECIMAL($precision, $scale)");
    }




    /**
     * Pseudonym of DECIMAL
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function numeric(string $name): ColumnInterface
    {
        return $this->addColumn($name, "NUMERIC");
    }




    /**
     * Pseudonym of DECIMAL
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function dec(string $name): ColumnInterface
    {
        return $this->addColumn($name, "DEC");
    }




    /**
     * Pseudonym of DECIMAL
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function fixed(string $name): ColumnInterface
    {
        return $this->addColumn($name, "FIXED");
    }




    /**
     * @inheritDoc
    */
    public function double(string $name, int $precision, int $scale): ColumnInterface
    {
        // DOUBLE PRECISION OR REAL
        return $this->addColumn($name, "DOUBLE($precision, $scale)");
    }




    /**
     * @inheritDoc
    */
    public function enum(string $name, array $values): ColumnInterface
    {
        return $this->addColumn($name, "ENUM(". join(', ', $values) . ")");
    }







    /**
     * @inheritDoc
    */
    public function json(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'JSON');
    }






    /**
     * @inheritDoc
    */
    public function morphs(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'TODO');
    }





    /**
     * Returns 0 or 1
     *
     * @param string $name
     * @return ColumnInterface
    */
    public function bool(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'BOOL');
    }







    /**
     * @return QueryResultInterface
    */
    public function fetchColumnsQuery(): QueryResultInterface
    {
        return $this->statement(sprintf('SHOW FULL COLUMNS FROM %s;', $this->name))->fetch();
    }






    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {
        $columns = [];

        foreach ($this->fetchColumnsQuery()->all() as $data) {
            $columns[] = $this->columnFactory->createColumnFromInfo(
                new MysqlColumnInfo($data)
            );
        }

        return $columns;
    }





    /**
     * @inheritdoc
    */
    public function getColumnNames(): array
    {
        return $this->fetchColumnsQuery()->columns();
    }





    /**
     * @inheritDoc
    */
    public function getConstraints(string $constraintType = null): array
    {
        $constraints = [];

        foreach ($this->fetchAllConstraints($constraintType) as $data) {
            $info           =  new ConstraintInfo($data);
            $constraintType = $info->get('CONSTRAINT_TYPE');
            $constraints[] = (new Constraint(
                $constraintType,
                $info->get('CONSTRAINT_NAME')
            ))->withOptions($info->getData());
        }

        return $constraints;
    }





    /**
     * @return array
    */
    public function fetchIndexes(): array
    {
        return  $this->statement("SHOW INDEXES FROM $this->name;")
                     ->fetch()
                     ->all();
    }





    /**
     * @inheritDoc
    */
    public function getIndexes(): array
    {
        $indexes = [];

        foreach ($this->fetchIndexes() as $data) {
            $info      = new ConstraintInfo($data);
            $index     = new Index([$info->get('Column_name')], $info->get('Key_name'));
            $indexType = $info->get('Index_type');
            $indexes[$indexType][] = $index->type($indexType)->withOptions($info->getData());
        }

        return $indexes;
    }






    /**
     * @inheritDoc
    */
    public function getUniques(): array
    {
        return array_filter($this->getConstraints(), function (Constraint $constraint) {
            return ($constraint->getType() === 'UNIQUE');
        });
    }




    /**
     * @inheritDoc
    */
    public function getPrimaryKeys(): array
    {
        return array_filter($this->getConstraints(), function (Constraint $constraint) {
            return ($constraint->getKey() === 'PRIMARY');
        });
    }





    /**
     * @inheritdoc
    */
    public function listConstraints(): array
    {
        $qb = $this->connection->createQueryBuilder();

        return $qb->select("*")
                  ->from('information_schema.table_constraints')
                  ->getQuery()
                  ->fetch()
                  ->all();
    }





    /**
     * @inheritDoc
    */
    public function getForeignKeys(): array
    {
        return array_filter($this->getConstraints(), function (Constraint $constraint) {
            return ($constraint->getType() === 'FOREIGN KEY');
        });
    }






    /**
     * @inheritDoc
    */
    public function foreignKeyChecks(callable $func): mixed
    {
        $this->exec("SET foreign_key_checks = 0;");
        $func($this);
        return $this->exec("SET foreign_key_checks = 1;");
    }






    /**
     * @inheritDoc
    */
    public function dropForeignKeys(): static
    {
        foreach ($this->getForeignKeys() as $foreignKey) {
            $this->exec("ALTER TABLE $this->name DROP FOREIGN KEY ". $foreignKey->getKey());
        }

        return $this;
    }








    /**
     * @param string|null $constraintType
     * @return array
     */
    public function fetchAllConstraints(string $constraintType = null): array
    {
        $qb = $this->connection->createQueryBuilder();

        $criteria = [
            'information_schema.table_constraints.TABLE_SCHEMA' => $this->getSchemaName(),
            'information_schema.table_constraints.TABLE_NAME'   => $this->getName()
        ];

        if ($constraintType) {
            $criteria['information_schema.table_constraints.CONSTRAINT_TYPE'] = $constraintType;
        }


        return $qb->select()
                  ->from('information_schema.table_constraints')
                  ->criteria($criteria)
                  ->getQuery()
                  ->fetch()
                  ->all();
    }
}
