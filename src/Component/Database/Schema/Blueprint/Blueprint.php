<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Schema\Column\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * Blueprint (Decorator TableInterface)
 *
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint
*/
class Blueprint
{
    /**
     * @param TableInterface $table
    */
    public function __construct(protected TableInterface $table)
    {

    }




    /**
     * @return mixed
    */
    public function create(): mixed
    {
        return $this->table->create();
    }




    /**
     * @return mixed
    */
    public function update(): mixed
    {
        return $this->table->update();
    }




    /**
     * @return mixed
    */
    public function drop(): mixed
    {
        return $this->table->drop();
    }






    /**
     * @param string $name
     * @param string $type
     * @return ColumnInterface
    */
    public function addColumn(string $name, string $type): ColumnInterface
    {
        return $this->table->addColumn($name, $type);
    }







    /**
     * @param string $name
     * @return TableInterface
    */
    public function dropColumn(string $name): TableInterface
    {
        return $this->table->dropColumn($name);
    }





    /**
     * @param string $name
     * @param string $to
     * @return TableInterface
    */
    public function renameColumn(string $name, string $to): TableInterface
    {
        return $this->table->renameColumn($name, $to);
    }




    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function increments(string $name): ColumnInterface
    {
        return $this->table->increments($name)->primary();
    }





    /**
     * @return ColumnInterface
    */
    public function id(): ColumnInterface
    {
        return $this->increments('id');
    }




    /**
     * @param string $name
     * @param int $length
     * @return ColumnInterface
    */
    public function string(string $name, int $length = 255): ColumnInterface
    {
        return $this->table->string($name, $length);
    }






    /**
     * @param $name
     * @return ColumnInterface
    */
    public function datetime($name): ColumnInterface
    {
       return $this->table->datetime($name);
    }




    /**
     * Add column type default
     *
     * @param $value
     *
     * @return mixed
    */
    public function default($value): static
    {
        foreach ($this->table->getColumns() as $column) {
            $this->table->add($column->default($value));
        }

        return $this;
    }





    /**
     * Add column type timestamp
     *
     * @return mixed
    */
    public function unsigned(): mixed
    {

    }





    /**
     * @return ColumnInterface
    */
    public function rememberToken(): ColumnInterface
    {
        return $this->string('remember_token', 100)->nullable();
    }





    /**
     * @param array $columns
     * @return static
    */
    public function primary(array $columns): static
    {
        $this->table->primary($columns);

        return $this;
    }





    /**
     * @param array $columns
     * @return $this
    */
    public function unique(array $columns): static
    {
        $this->table->unique($columns);

        return $this;
    }





    public function foreign(string $name): ForeignKeyInterface
    {
        return $this->table->foreign($name);
    }
}
