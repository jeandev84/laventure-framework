<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Criteria;

/**
 * Criteria
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\Criteria
*/
class Criteria implements CriteriaInterface
{
    /**
     * @var string[]
    */
    public array $columns = [];



    /**
     * @var string[]
    */
    public array $from = [];



    /**
     * @var string[]
    */
    public array $joins = [];



    /**
     * @var string[]
    */
    public array $groupBy = [];




    /**
     * @var string[]
    */
    public array $having = [];





    /**
     * @var string[]
    */
    public array $orderBy = [];






    /**
     * @var null
    */
    public $offset = null;





    /**
     * @var null
    */
    public $limit = null;






    /**
     * @var string[]
    */
    public array $set = [];





    /**
     * @var array
    */
    public array $wheres = [];




    /**
     * @var null
    */
    public $table = null;




    /**
     * @var array
    */
    public array $alias = [];





    /**
     * @var array
    */
    public array $values = [];





    /**
     * @var array
    */
    public array $parameters = [];





    /**
     * @var array
    */
    public array $bindParams = [];




    /**
     * @var array
    */
    public array $bindValues = [];





    /**
     * @var array
    */
    public array $bindColumns = [];




    /**
     * @var string|null
    */
    public $classname = null;



    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
        return get_object_vars($this);
    }






    /**
     * @param string $name
     * @param $value
     * @return void
    */
    public function __set(string $name, $value): void
    {
        if (property_exists($this, $name)) {
            $this->{$name} = $value;
        }
    }






    /**
     * @param string $name
     * @return mixed
    */
    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        return null;
    }
}
