<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder\Contract;

/**
 * CreateTableSQLBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Builder\Contract
*/
interface CreateTableSQLBuilderInterface
{

    /**
     * @return string
    */
    public function getTable(): string;




    /**
     * @return string
    */
    public function getCriteria(): string;




    /**
     * @return string
    */
    public function getSQL(): string;
}
