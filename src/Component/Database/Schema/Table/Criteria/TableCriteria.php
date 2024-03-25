<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Criteria;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Index;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Unique\UniqueKey;

/**
 * TableCriteria
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Criteria
*/
class TableCriteria implements TableCriteriaInterface
{
    /**
     * Collect available columns
     *
     * @var array<string, ColumnInterface>
    */
    public array $columns  = [];




    /**
     * Collect added columns
     *
     * @var array<string, ColumnInterface>
    */
    public array $newColumn = [];





    /**
     * Collect renamed columns
     *
     * @var array<string, ColumnInterface>
    */
    public array $renameColumn = [];





    /**
     * Collect modified columns
     *
     * @var array<string, ColumnInterface>
    */
    public array $modifyColumn = [];





    /**
     * Collect dropped columns
     *
     * @var array<string, ColumnInterface>
    */
    public array $dropColumn = [];







    /**
     * Collect primary keys
     *
     * @var string[]
    */
    public array $primary = [];






    /**
     * Collect unique keys
     *
     * @var string[]
    */
    public array $unique = [];








    /**
     * Collect indexes
     *
     * @var string[]
    */
    public array $index = [];







    /**
     * Collect foreign keys
     *
     * @var ForeignKeyInterface[]
    */
    public array $foreign = [];







    /**
     * @inheritDoc
    */
    public function getPrimary(): PrimaryKeyInterface
    {
        return new PrimaryKey($this->primary);
    }





    /**
     * @inheritDoc
    */
    public function getIndex(): IndexInterface
    {
        return new Index($this->index);
    }






    /**
     * @inheritDoc
    */
    public function getUnique(): UniqueKeyInterface
    {
        return new UniqueKey($this->unique);
    }





    /**
     * @inheritDoc
    */
    public function getForeign(): array
    {
        return $this->foreign;
    }




    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
        return get_object_vars($this);
    }




    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->newColumn = [];
        $this->primary = [];
        $this->unique  = [];
        $this->index   = [];
        $this->foreign = [];
        $this->create  = [];
        $this->renameColumn  = [];
    }
}
