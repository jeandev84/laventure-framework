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
     * @param $table
     * @return $this
    */
    public function create($table): static;






    /**
     * @param array $criteria
     * @return $this
    */
    public function criteria(array $criteria): static;







    /**
     * @return string
    */
    public function getSQL(): string;
}
