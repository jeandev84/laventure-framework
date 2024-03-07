<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL;


use Laventure\Component\Database\ORM\Persistence\Query\QueryInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;

/**
 * BuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL
*/
interface BuilderInterface
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
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed;







    /**
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
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface;






    /**
     * @return ExpressionBuilderInterface
    */
    public function expr(): ExpressionBuilderInterface;
}