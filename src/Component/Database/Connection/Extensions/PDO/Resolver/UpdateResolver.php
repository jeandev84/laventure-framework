<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Resolver;

use Laventure\Component\Database\Builder\SQL\DML\Update\Resolver\UpdateResolverInterface;
use Laventure\Component\Database\Builder\SQL\DML\Update\UpdateBuilderInterface;

/**
 * UpdateResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Resolver
*/
class UpdateResolver implements UpdateResolverInterface
{

    /**
     * @param UpdateBuilderInterface $qb
    */
    public function __construct(
        protected UpdateBuilderInterface $qb
    )
    {
    }



    /**
     * @inheritDoc
    */
    public function resolve(array $attributes): UpdateBuilderInterface
    {
        foreach ($attributes as $column => $value) {
            $this->qb->set($column, ":$column");
            $this->qb->setParameter($column, $value);
        }

        return $this->qb;
    }
}