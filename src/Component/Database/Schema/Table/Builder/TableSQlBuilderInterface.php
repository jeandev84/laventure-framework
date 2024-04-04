<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder;

use Laventure\Component\Database\Query\Builder\SQL\Contract\SQLInterface;
use Laventure\Component\Database\Schema\Table\Builder\Contract\CreateTableSQLBuilderInterface;
use Laventure\Component\Database\Schema\Table\Builder\Contract\UpdateTableSQLBuilderInterface;

/**
 * TableSQlBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Criteria
*/
interface TableSQlBuilderInterface extends SQLInterface
{
    /**
     * @return CreateTableSQLBuilderInterface
    */
    public function create(): CreateTableSQLBuilderInterface;






    /**
     * @return UpdateTableSQLBuilderInterface
    */
    public function update(): UpdateTableSQLBuilderInterface;
}
