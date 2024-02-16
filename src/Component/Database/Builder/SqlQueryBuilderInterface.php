<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder;

use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertSQlBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;

/**
 * SQlQueryBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
interface SqlQueryBuilderInterface
{
    /**
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface;




    /**
     * @param string ...$selects
     * @return SelectBuilderInterface
    */
    public function select(string ...$selects): SelectBuilderInterface;




    /**
     * @param string $table
     * @return InsertSQlBuilderInterface
    */
    public function insert(string $table): InsertSQlBuilderInterface;





    /**
     * @param string $table
     * @return UpdateBuilderInterface
    */
    public function update(string $table): UpdateBuilderInterface;





    /**
     * @param string $table
     * @return DeleteBuilderInterface
    */
    public function delete(string $table): DeleteBuilderInterface;
}
