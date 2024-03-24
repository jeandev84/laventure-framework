<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder;

use Laventure\Component\Database\Schema\Table\Table;

/**
 * TableSQlBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Criteria
*/
class TableSQlBuilder implements TableSQlBuilderInterface
{
    /**
     * @param Table $table
    */
    public function __construct(protected Table $table)
    {
    }



    /**
     * @inheritDoc
    */
    public function getCreateTableSQL(): string
    {

    }





    /**
     * @inheritDoc
    */
    public function getUpdateTableSQL(): string
    {

    }
}
