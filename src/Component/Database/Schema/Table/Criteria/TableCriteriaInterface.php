<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Criteria;

/**
 * TableCriteriaInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Criteria
 */
interface TableCriteriaInterface
{
    /**
     * Returns create criteria as string
     *
     * @return string
    */
    public function create(): string;





    /**
     * Returns create criteria as string
     *
     * @return string
    */
    public function update(): string;
}
