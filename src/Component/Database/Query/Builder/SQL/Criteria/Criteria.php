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
 * @package  Laventure\Component\Database\Builder\SQL\Criteria
*/
class Criteria
{
    /**
     * @var string[]
    */
    public array $selects = [];


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
     * @var array
    */
    public array $insert = [];



    /**
     * @var array
    */
    public array $values = [];




    /**
     * @var array
    */
    public array $update = [];




    /**
     * @var array
    */
    public array $set = [];




    /**
     * @var array
    */
    public array $wheres = [];





    /**
     * @var array
    */
    public array $parameters = [];




    /**
     * @var array
    */
    public array $bindingParams = [];




    /**
     * @var array
    */
    public array $bindingValues = [];
}
