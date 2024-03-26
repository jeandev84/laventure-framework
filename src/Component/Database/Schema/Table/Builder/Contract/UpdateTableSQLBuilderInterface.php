<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder\Contract;

use Laventure\Component\Database\Query\Builder\SQL\Contract\SQLInterface;
use Laventure\Component\Database\Schema\Table\Constraint\TableConstraintInterface;

/**
 * UpdateTableSQLBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Builder\Contract
*/
interface UpdateTableSQLBuilderInterface extends SQLInterface
{
    /**
     * @return string
    */
    public function getTableName(): string;




    /**
     * @return string
    */
    public function getCriteria(): string;





    /**
     * @return string
    */
    public function getSQL(): string;
}
