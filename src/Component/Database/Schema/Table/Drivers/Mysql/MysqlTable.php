<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Drivers\Mysql;

use Laventure\Component\Database\Query\Result\QueryResultInterface;
use Laventure\Component\Database\Schema\Column\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Drivers\Mysql\MysqlColumn;
use Laventure\Component\Database\Schema\Column\Info\ColumnInfo;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign\ForeignKey;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
use Laventure\Component\Database\Schema\Table\Exceptions\TableException;
use Laventure\Component\Database\Schema\Table\Table;
use RuntimeException;
use function _PHPStan_3d4486d07\RingCentral\Psr7\str;

/**
 * MysqlTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Drivers\Mysql
 *
 * @see https://www.w3schools.com/sql/sql_datatypes.asp
 * @see https://www.w3schools.com/sql/sql_ref_mysql.asp
 * @see https://metanit.com/sql/mysql/2.3.php
*/
class MysqlTable extends Table
{
    /**
     * @inheritDoc
    */
    public function column(
        string $name,
        string $type = '',
        string $constraints = ''
    ): ColumnInterface {
        return new MysqlColumn($name, $type, $constraints);
    }






    /**
     * @inheritDoc
    */
    public function create(): bool
    {
        $this->exec(
            sprintf('CREATE TABLE IF NOT EXISTS `%s` (%s);',
                $this->name,
                $this->createCriteria()
            )
        );

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
     * @inheritDoc
    */
    public function getColumns(): array
    {
        return $this->fetchColumnsQuery()->columns();
    }




    /**
     * @inheritDoc
    */
    public function getColumnsInfo(): array
    {
        $columns = [];

        foreach ($this->fetchColumnsQuery()->all() as $info) {
            if (is_array($info)) {
                $columns[] = new ColumnInfo($info);
            }
        }

        return $columns;
    }




    /**
     * @inheritDoc
    */
    public function getIndexes(): array
    {
        return $this->statement("SHOW INDEXES FROM $this->name;")
                    ->fetch()
                    ->all();
    }





    /**
     * @inheritDoc
    */
    public function getPrimaryKeys(): array
    {
         return [];
    }





    /**
     * @return array
    */
    public function getAllForeignKeysOfSystem(): array
    {
        $qb = $this->connection->createQueryBuilder();

        return $qb->select("*")
                  ->from('information_schema.table_constraints')
                  ->fetch()
                  ->all();
    }





    /**
     * @inheritDoc
    */
    public function getForeignKeys(): array
    {
        $qb = $this->connection->createQueryBuilder();

        return $qb->select("*")
                  ->from('information_schema.table_constraints')
                  ->andWhere('information_schema.table_constraints.CONSTRAINT_TYPE = :foreignKey')
                  ->andWhere('information_schema.table_constraints.TABLE_SCHEMA = :tableSchema')
                  ->andWhere('information_schema.table_constraints.TABLE_NAME = :tableName')
                  ->setParameters([
                      'foreignKey'  => 'FOREIGN KEY',
                      'tableSchema' => $this->getSchemaName(),
                      'tableName'   => $this->getName()
                  ])
                  ->fetch()
                  ->all();
    }








    /**
     * @inheritDoc
    */
    public function getUniques(): array
    {
        return [];
    }




    /**
     * @inheritDoc
    */
    public function getConstraints(): array
    {
        return [];
    }





    /**
     * @return QueryResultInterface
    */
    protected function fetchColumnsQuery(): QueryResultInterface
    {
        return $this->statement(sprintf('SHOW FULL COLUMNS FROM %s;', $this->name))
                    ->fetch();
    }



    protected function references(): array
    {
         /*
          all using constraints
          $this->statement("select * from information_schema.table_constraints")
               ->fetch()
               ->all();
          [
              0 => array:7 [
                "CONSTRAINT_CATALOG" => "def"
                "CONSTRAINT_SCHEMA" => "dlc"
                "CONSTRAINT_NAME" => "Produits_ibfk_1"
                "TABLE_SCHEMA" => "dlc"
                "TABLE_NAME" => "Produits"
                "CONSTRAINT_TYPE" => "FOREIGN KEY"
                "ENFORCED" => "YES"
              ]
              1 => array:7 [
                "CONSTRAINT_CATALOG" => "def"
                "CONSTRAINT_SCHEMA" => "dlc"
                "CONSTRAINT_NAME" => "Ventes_ibfk_1"
                "TABLE_SCHEMA" => "dlc"
                "TABLE_NAME" => "Ventes"
                "CONSTRAINT_TYPE" => "FOREIGN KEY"
                "ENFORCED" => "YES"
              ]
              2 => array:7 [
                "CONSTRAINT_CATALOG" => "def"
                "CONSTRAINT_SCHEMA" => "dlc"
                "CONSTRAINT_NAME" => "Ventes_ibfk_2"
                "TABLE_SCHEMA" => "dlc"
                "TABLE_NAME" => "Ventes"
                "CONSTRAINT_TYPE" => "FOREIGN KEY"
                "ENFORCED" => "YES"
              ]
              3 => array:7 [
                "CONSTRAINT_CATALOG" => "def"
                "CONSTRAINT_SCHEMA" => "dlc"
                "CONSTRAINT_NAME" => "Ventes_ibfk_3"
                "TABLE_SCHEMA" => "dlc"
                "TABLE_NAME" => "Ventes"
                "CONSTRAINT_TYPE" => "FOREIGN KEY"
                "ENFORCED" => "YES"
              ]
              4 => array:7 [
                "CONSTRAINT_CATALOG" => "def"
                "CONSTRAINT_SCHEMA" => "laventure_test"
                "CONSTRAINT_NAME" => "goods_ibfk_1"
                "TABLE_SCHEMA" => "laventure_test"
                "TABLE_NAME" => "goods"
                "CONSTRAINT_TYPE" => "FOREIGN KEY"
                "ENFORCED" => "YES"
              ]
          ]
         */

         return [];
    }
}
