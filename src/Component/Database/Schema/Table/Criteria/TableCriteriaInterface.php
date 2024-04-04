<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Criteria;

use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;

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
     * Determine if has defined primary keys
     *
     * @return bool
    */
    public function hasPrimary(): bool;





    /**
     * @return PrimaryKeyInterface
    */
    public function getPrimary(): PrimaryKeyInterface;






    /**
     * @return IndexInterface
    */
    public function getIndex(): IndexInterface;






    /**
     * @return UniqueKeyInterface
    */
    public function getUnique(): UniqueKeyInterface;






    /**
     * ForeignKeys
     *
     * @return ForeignKeyInterface[]
    */
    public function getForeign(): array;







    /**
     * @return array
    */
    public function toArray(): array;







    /**
     * @return void
    */
    public function clear(): void;
}
