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
     * @return array
    */
    public function toArray(): array;





    /**
     * @return void
    */
    public function clear(): void;
}