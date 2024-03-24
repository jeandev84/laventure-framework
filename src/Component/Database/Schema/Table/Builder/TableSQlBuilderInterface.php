<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder;

/**
 * TableSQlBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Criteria
*/
interface TableSQlBuilderInterface
{
    /**
     * Returns create criteria as string
     *
     * @return string
    */
    public function getCreateTableSQL(): string;





    /**
     * Returns create sql
     *
     * @return string
    */
    public function getUpdateTableSQL(): string;
}
