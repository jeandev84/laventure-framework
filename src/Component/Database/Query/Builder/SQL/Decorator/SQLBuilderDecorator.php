<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Decorator;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * SQLBuilderDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Decorator
*/
abstract class SQLBuilderDecorator implements SQLBuilderInterface
{
    use SQLBuilderDecoratorTrait;


    /**
     * @param $builder
    */
    public function __construct($builder)
    {
        $this->withBuilder($builder);
    }
}
