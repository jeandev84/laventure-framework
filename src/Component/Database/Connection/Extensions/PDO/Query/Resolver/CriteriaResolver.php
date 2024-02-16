<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Resolver;

use Laventure\Component\Database\Builder\SQL\Conditions\Contract\SQlBuilderConditionInterface;
use Laventure\Component\Database\Builder\SQL\Conditions\Resolver\CriteriaResolverInterface;

/**
 * ConditionResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Query\Resolver
 */
class CriteriaResolver implements CriteriaResolverInterface
{
    /**
     * @param SQlBuilderConditionInterface $qb
    */
    public function __construct(
        protected SQlBuilderConditionInterface $qb
    ) {
    }




    /**
     * @inheritDoc
    */
    public function resolve(array $criteria): mixed
    {
        $expr = $this->qb->expr();

        foreach ($criteria as $column => $value) {
            if (is_array($value)) {
                $this->qb->where(
                    strval($expr->in($column, ":$column"))
                );
            } else {
                $this->qb->andWhere(
                    strval($expr->eq($column, ":$column"))
                );
            }
            $this->qb->setParameter($column, $value);
        }

        return $this->qb;
    }
}
