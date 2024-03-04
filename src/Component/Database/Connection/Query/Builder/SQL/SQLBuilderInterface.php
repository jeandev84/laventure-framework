<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Criteria\SQLCriteriaResolverInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Connection\Query\QueryInterface;
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
interface SQLBuilderInterface extends Stringable
{
    /**
     * @return string
    */
    public function getSQL(): string;







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
}
