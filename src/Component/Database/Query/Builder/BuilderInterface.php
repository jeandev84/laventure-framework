<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder;

use Laventure\Component\Database\Builder\SQL\Conditions\Contract\HasConditionInterface;
use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilder;
use Laventure\Component\Database\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DQL\Select\SelectBuilderInterface;
use Laventure\Component\Database\Builder\SQL\ExpressionInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;


/**
 * BuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder
*/
interface BuilderInterface
{

    /**
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface;





    /**
     * Select query
     * @param string|null $columns
     * @param array $criteria
     * @return SelectBuilderInterface
    */
    public function select(string $columns = null, array $criteria = []): SelectBuilderInterface;





    /**
     * Insert data
     *
     * @param string $table
     * @param array $attributes
     * @return InsertBuilderInterface
    */
    public function insert(string $table, array $attributes): InsertBuilderInterface;





    /**
     * @param string $table
     * @param array $attributes
     * @param array $criteria
     * @return UpdateBuilderInterface
    */
    public function update(string $table, array $attributes, array $criteria = []): UpdateBuilderInterface;






    /**
     * Delete a record
     *
     * @param string $table
     * @param array $criteria
     * @return DeleteBuilderInterface
    */
    public function delete(string $table, array $criteria = []): DeleteBuilderInterface;
}