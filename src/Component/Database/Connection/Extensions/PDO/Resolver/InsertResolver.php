<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Resolver;

use Laventure\Component\Database\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Builder\SQL\DML\Insert\Resolver\InsertResolverInterface;

/**
 * InsertResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Resolver
 */
class InsertResolver implements InsertResolverInterface
{


    /**
     * @param InsertBuilderInterface $qb
    */
    public function __construct(protected InsertBuilderInterface $qb)
    {
    }




    /**
     * @inheritDoc
    */
    public function resolve(array $attributes): InsertBuilderInterface
    {
        if (isset($attributes[0])) {
            foreach ($attributes as $position => $values) {
                foreach ($values as $column => $value) {
                    $this->qb->setValue($column, ":{$column}_{$position}", $position);
                    $this->qb->setParameter("{$column}_{$position}", $value);
                }
            }
        } else {
            foreach ($attributes as $column => $value) {
                $this->qb->setValue($column, ":$column");
                $this->qb->setParameter($column, $value);
            }
        }

        return $this->qb;
    }
}