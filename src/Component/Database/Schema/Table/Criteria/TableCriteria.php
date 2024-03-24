<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Criteria;

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
     * @var array
    */
    public array $columns = [];




    /**
     * @var array
    */
    public array $create = [];




    /**
     * @var array
    */
    public array $update = [];






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
        $this->create  = [];
        $this->update  = [];
        $this->columns = [];
    }
}