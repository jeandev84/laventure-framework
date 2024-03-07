<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions;

use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\andX;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Conditions\orX;
use Laventure\Contract\Builder\BuilderInterface;
use RuntimeException;

/**
 * ConditionBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions
*/
class SQLConditionBuilder implements BuilderInterface
{
    protected array $conditions = [];


    /**
     * @param array $conditions
    */
    public function __construct(array $conditions)
    {
        $this->conditions = $this->resolve($conditions);
    }




    /**
     * @return array
    */
    public function getConditions(): array
    {
        return $this->conditions;
    }





    /**
     * @return bool
    */
    public function empty(): bool
    {
        return empty($this->conditions);
    }




    /**
     * @inheritDoc
    */
    public function build(): string
    {
        return join(' ', $this->getConditions());
    }






    /**
     * @param array $conditions
     * @return array
    */
    private function resolve(array $conditions): array
    {
        if (!empty($conditions[ConditionType::DEFAULT])) {
            return $conditions[ConditionType::DEFAULT];
        }

        $resolved = [];
        $key      = key($conditions);

        foreach ($conditions as $type => $criteria) {
            if (!empty($criteria)) {
                $criteriaAsString = join(', ', $criteria);
                $having = match($type) {
                    ConditionType::AND => new andX($criteria),
                    ConditionType::OR  => new orX($criteria),
                    default            => new RuntimeException(
                        "Could not get criteria type ($type) ($criteriaAsString)"
                    )
                };
                if ($key !== $type) {
                    $resolved[] = $type;
                }
                $resolved[] = strval($having);
            }
        }

        return $resolved;
    }
}
