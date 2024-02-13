<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Conditions;

/**
 * CriteriaResolved
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions
*/
class CriteriaResolved
{

     /**
      * @var array
     */
     public array $wheres = [];



     /**
      * @var array
     */
     public array $parameters = [];
}