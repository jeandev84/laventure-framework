<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Criteria;

use Laventure\Component\Database\Schema\Table\TableInterface;

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
     * @param TableInterface $table
    */
    public function __construct(protected TableInterface $table)
    {
    }



    /**
     * @inheritDoc
    */
    public function create(): string
    {

    }

    /**
     * @inheritDoc
    */
    public function update(): string
    {

    }
}