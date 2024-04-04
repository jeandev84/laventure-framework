<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\Criteria;

use Laventure\Component\Database\Query\Builder\SQL\Criteria\Criteria;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;

/**
 * QueryBuilderCriteria
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\Criteria
*/
class QueryBuilderCriteria extends Criteria implements CriteriaInterface
{

    /**
     * @var array
    */
    protected array $merge = [];



    /**
     * @param array $criteria
     * @return $this
    */
    public function merge(array $criteria): static
    {
        $this->merge = $criteria;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
         return array_merge(
             parent::toArray(),
             $this->merge
         );
    }
}