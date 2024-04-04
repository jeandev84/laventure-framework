<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Contract\SQLInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Stringable;

/**
 * SQLBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL
*/
interface SQLBuilderInterface extends SQLInterface
{
    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static;





    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setParameter($id, $value): static;







    /**
     * Returns parameter value
     *
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed;







    /**
     * Returns parameters
     *
     * @return array
    */
    public function getParameters(): array;






    /**
     * @param $id
     * @param $value
     * @param int $type
     * @return $this
    */
    public function bindParam($id, $value, int $type = 0): static;







    /**
     * @param $id
     * @param $value
     * @param int $type
     * @return $this
    */
    public function bindValue($id, $value, int $type = 0): static;







    /**
     * @param $id
     * @param $value
     * @param int $type
     * @return $this
    */
    public function bindColumn($id, $value, int $type = 0): static;










    /**
     * @return array
   */
    public function getBindingParams(): array;







    /**
     * @return array
    */
    public function getBindingValues(): array;






    /**
     * @return array
    */
    public function getBindingColumns(): array;






    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;









    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;






    /**
     * @return ExpressionBuilderInterface
    */
    public function expr(): ExpressionBuilderInterface;







    /**
     * @return CriteriaInterface
    */
    public function getCriteria(): CriteriaInterface;
}
