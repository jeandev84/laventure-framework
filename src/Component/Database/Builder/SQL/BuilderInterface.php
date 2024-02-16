<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL;

use Laventure\Component\Database\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * BuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
interface BuilderInterface extends CriteriaInterface
{


    /**
     * @return string
    */
    public function getSQL(): string;





    /**
     * @param $id
     * @param $value
     * @param $type
     * @return $this
    */
    public function bindParam($id, $value, $type = null): static;






    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setParameter($id, $value): static;






    /**
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed;






    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static;






    /**
     * @return array
    */
    public function getParameters(): array;





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
     * @return string
    */
    public function getName(): string;
}
