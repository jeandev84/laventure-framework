<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\Factory;

use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionInterface;

/**
 * SQLBuilderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
interface SQLBuilderFactoryInterface
{
    /**
     * Create expression builder
     *
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface;



    /**
     * Create select builder
     *
     * @return SelectBuilderInterface
    */
    public function createSelectBuilder(): SelectBuilderInterface;





    /**
     * Create insert builder
     *
     * @return InsertBuilderInterface
    */
    public function createInsertBuilder(): InsertBuilderInterface;






    /**
     * Create update builder
     *
     * @return UpdateBuilderInterface
    */
    public function createUpdateBuilder(): UpdateBuilderInterface;






    /**
     * Create delete builder
     *
     * @return DeleteBuilderInterface
    */
    public function createDeleteBuilder(): DeleteBuilderInterface;
}
