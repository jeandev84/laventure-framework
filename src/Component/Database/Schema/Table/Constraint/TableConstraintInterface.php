<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Constraint;

use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;

/**
 * TableConstraintInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Constraint
 */
interface TableConstraintInterface
{
    /**
     * @return PrimaryKeyInterface
    */
    public function getPrimary(): PrimaryKeyInterface;


    /**
     * @return UniqueKeyInterface
    */
    public function getUnique(): UniqueKeyInterface;



    /**
     * @return IndexInterface
    */
    public function getIndex(): IndexInterface;




    /**
     * @return array
    */
    public function foreign(): array;
}
