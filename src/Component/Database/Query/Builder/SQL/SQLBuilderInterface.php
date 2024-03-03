<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
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
interface SQLBuilderInterface extends Stringable
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
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface;





    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;
}
