<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Factory;

use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;

/**
 * SQLBuilderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Factory
 */
interface SQLBuilderFactoryInterface
{
    /**
     * @return ExpressionBuilderInterface
    */
    public function createExpr(): ExpressionBuilderInterface;



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
