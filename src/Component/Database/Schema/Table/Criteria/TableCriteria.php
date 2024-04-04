<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Criteria;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Index\Index;
use Laventure\Component\Database\Schema\Constraints\Types\Index\NullIndex;
use Laventure\Component\Database\Schema\Constraints\Types\Primary\NullPrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Unique\NullUniqueKey;
use Laventure\Component\Database\Schema\Constraints\Types\Unique\UniqueKey;

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
     * @var ConstraintInterface[]
    */
    public array $constraint = [];




    /**
     * @inheritDoc
    */
    public function getPrimary(): PrimaryKeyInterface
    {
        if (empty($this->primary)) {
            return new NullPrimaryKey();
        }

        return new PrimaryKey($this->primary);
    }





    /**
     * @inheritDoc
    */
    public function getIndex(): IndexInterface
    {
        if (empty($this->index)) {
            return new NullIndex([]);
        }

        return new Index($this->index);
    }






    /**
     * @inheritDoc
    */
    public function getUnique(): UniqueKeyInterface
    {
        if (empty($this->unique)) {
            return new NullUniqueKey();
        }

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
    public function hasPrimary(): bool
    {
        return !empty($this->primary);
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
        $this->columns       = [];
        $this->newColumn     = [];
        $this->renameColumn  = [];
        $this->primary       = [];
        $this->unique        = [];
        $this->index         = [];
        $this->foreign       = [];
    }
}
