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
class Blueprint implements BlueprintInterface
{
    /**
     * @param TableInterface $table
    */
    public function __construct(
        protected TableInterface $table
    ) {

    }




    /**
     * @inheritDoc
    */
    public function create(): mixed
    {
        return $this->table->create();
    }




    /**
     * @inheritDoc
    */
    public function update(): mixed
    {
        return $this->table->update();
    }





    /**
     * @inheritDoc
    */
    public function drop(): mixed
    {
        return $this->table->drop();
    }




    /**
     * @inheritDoc
    */
    public function addColumn($name, $type, $default = null): ColumnInterface
    {
        return $this->table->addColumn($name, $type, [

        ]);
    }




    /**
     * @inheritDoc
    */
    public function dropColumn($name): mixed
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
     * @inheritDoc
    */
    public function increments($name): ColumnInterface
    {
        return $this->table->increments($name)->primary();
    }




    /**
     * @inheritDoc
    */
    public function id(): mixed
    {
        return $this->increments('id');
    }



    /**
     * @inheritDoc
    */
    public function string($name): ColumnInterface
    {

    }




    /**
     * @inheritDoc
    */
    public function datetime($name): mixed
    {
        // TODO: Implement datetime() method.
    }
}
