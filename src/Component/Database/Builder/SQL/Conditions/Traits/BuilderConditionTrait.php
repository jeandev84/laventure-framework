<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Conditions\Traits;


use Laventure\Component\Database\Builder\SQL\BuilderTrait;
use Laventure\Component\Database\Builder\SQL\Expr\Where;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * BuilderConditionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions\Traits
*/
trait BuilderConditionTrait
{
   use BuilderTrait;


   /**
     * @param ConnectionInterface $connection
   */
   public function __construct(ConnectionInterface $connection)
   {
       parent::__construct($connection);
   }




    /**
     * @param string $condition
     * @return $this
    */
    public function where(string $condition): static
    {
        $this->criteria->wheres[] = $condition;

        return $this;
    }





    /**
     * @param string $condition
     * @return $this
    */
    public function andWhere(string $condition): static
    {
        return $this->where(strval($this->expr->andX($condition)));
    }






    /**
     * @param string $condition
     * @return $this
    */
    public function orWhere(string $condition): static
    {
        return $this->where(strval($this->expr->orX($condition)));
    }








    /**
     * @return array
    */
    public function getConditions(): array
    {
        return $this->criteria->wheres;
    }




    /**
     * @return Where
    */
    public function getWhere(): Where
    {
        return new Where($this->criteria->wheres);
    }
}