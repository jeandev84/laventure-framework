<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Drivers\Mysql;

use Laventure\Component\Database\Query\Result\QueryResultInterface;
use Laventure\Component\Database\Schema\Column\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Drivers\Mysql\MysqlColumn;
use Laventure\Component\Database\Schema\Column\Info\ColumnInfo;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign\ForeignKey;
use Laventure\Component\Database\Schema\Table\Table;

/**
 * MysqlTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Drivers\Mysql
*/
class MysqlTable extends Table
{
    /**
     * @inheritDoc
    */
    public function createColumn(
        string $name,
        string $type = '',
        string $constraints = ''
    ): ColumnInterface
    {
        return new MysqlColumn($name, $type, $constraints);
    }




    /**
     * @inheritDoc
    */
    public function create(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function increments(string $name): ColumnInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function bigIncrements(string $name): ColumnInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function integer(string $name, int $length = 11): ColumnInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function smallInteger(string $name): ColumnInterface
    {
        // TODO: Implement smallInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function bigInteger(string $name): ColumnInterface
    {
        // TODO: Implement bigInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumInteger(string $name): ColumnInterface
    {
        // TODO: Implement mediumInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyInteger(string $name): ColumnInterface
    {
        // TODO: Implement tinyInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function char(string $name, $value): ColumnInterface
    {
        // TODO: Implement char() method.
    }

    /**
     * @inheritDoc
     */
    public function datetime(string $name): ColumnInterface
    {
        // TODO: Implement datetime() method.
    }

    /**
     * @inheritDoc
     */
    public function time(string $name): ColumnInterface
    {
        // TODO: Implement time() method.
    }

    /**
     * @inheritDoc
     */
    public function timestamp(string $name): ColumnInterface
    {
        // TODO: Implement timestamp() method.
    }

    /**
     * @inheritDoc
     */
    public function binary(string $name): ColumnInterface
    {
        // TODO: Implement binary() method.
    }

    /**
     * @inheritDoc
     */
    public function date(string $name): ColumnInterface
    {
        // TODO: Implement date() method.
    }

    /**
     * @inheritDoc
     */
    public function decimal(string $name, int $precision, int $scale): ColumnInterface
    {
        // TODO: Implement decimal() method.
    }

    /**
     * @inheritDoc
     */
    public function double(string $name, int $precision, int $scale): ColumnInterface
    {
        // TODO: Implement double() method.
    }

    /**
     * @inheritDoc
     */
    public function enum(string $name, array $values): ColumnInterface
    {
        // TODO: Implement enum() method.
    }

    /**
     * @inheritDoc
     */
    public function float(string $name): ColumnInterface
    {
        // TODO: Implement float() method.
    }

    /**
     * @inheritDoc
     */
    public function json(string $name): ColumnInterface
    {
        // TODO: Implement json() method.
    }

    /**
     * @inheritDoc
     */
    public function longText(string $name): ColumnInterface
    {
        // TODO: Implement longText() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumText(string $name): ColumnInterface
    {
        // TODO: Implement mediumText() method.
    }




    /**
     * @inheritDoc
    */
    public function morphs(string $name): ColumnInterface
    {

    }



    /**
     * @inheritdoc
    */
    public function foreign(string $name): ForeignKeyInterface
    {
        return $this->addForeignKey(new ForeignKey($name, "(". $this->foreignKeyName($name) . ")"));
    }




    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {
       return $this->queryFetchColumns()->columns();
    }




    /**
     * @inheritDoc
    */
    public function getColumnsInfo(): array
    {
        $columns = [];

        foreach ($this->queryFetchColumns()->all() as $info) {
            if (is_array($info)) {
                $columns[] = new ColumnInfo($info);
            }
        }

        return $columns;
    }





    /**
     * @return QueryResultInterface
    */
    private function queryFetchColumns(): QueryResultInterface
    {
        return $this->statement(sprintf('SHOW FULL COLUMNS FROM %s', $this->name))
                    ->fetch();
    }
}
