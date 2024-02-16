<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Builder\SQL\Criteria\HasCriteriaInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * SQlBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
interface SQlBuilderInterface extends HasCriteriaInterface
{


    /**
     * @return string
    */
    public function getSQL(): string;





    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;





    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;





    /**
     * @return ExpressionInterface
    */
    public function expr(): ExpressionInterface;





    /**
     * @param Criteria $criteria
     * @return $this
    */
    public function criteria(Criteria $criteria): static;
}
