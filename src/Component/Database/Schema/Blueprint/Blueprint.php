<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Schema\Column\ColumnInterface;
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
    public function __construct(protected TableInterface $table) {

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
     * @param $name
     * @param $type
     * @param $default
     * @return ColumnInterface
    */
    public function addColumn($name, $type, $default = null): ColumnInterface
    {
        return $this->table->addColumn($name, $type);
    }







    /**
     * @param $name
     * @return TableInterface
    */
    public function dropColumn($name): TableInterface
    {
        return $this->table->dropColumn($name);
    }




    /**
     * @inheritDoc
    */
    public function renameColumn($name, $to): mixed
    {
        return $this->table->renameColumn($name, $to);
    }




    /**
     * @param $name
     * @return ColumnInterface
    */
    public function increments($name): ColumnInterface
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
     * @param $name
     * @return ColumnInterface
    */
    public function string($name): ColumnInterface
    {

    }





    /**
     * @param $name
     * @return TableInterface
    */
    public function datetime($name): TableInterface
    {

    }




    /**
     * @param array|string $primary
     * @return TableInterface
    */
    public function primary(array|string $primary): TableInterface
    {
        return $this->table->addConstraint();
    }
}
