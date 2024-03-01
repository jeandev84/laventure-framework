<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;

/**
 * SqlBuilderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
interface SqlBuilderFactoryInterface
{
    /**
     * @return ExpressionInterface
    */
    public function createExpressionBuilder(): ExpressionInterface;



    /**
     * @return SelectBuilderInterface
    */
    public function createSelectBuilder(): SelectBuilderInterface;





    /**
     * @return InsertBuilderInterface
    */
    public function createInsertBuilder(): InsertBuilderInterface;






    /**
     * @return UpdateBuilderInterface
    */
    public function createUpdateBuilder(): UpdateBuilderInterface;






    /**
     * @return DeleteBuilderInterface
    */
    public function createDeleteBuilder(): DeleteBuilderInterface;
}
