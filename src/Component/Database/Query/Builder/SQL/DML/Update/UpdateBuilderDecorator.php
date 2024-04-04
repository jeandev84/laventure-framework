<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Update;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Criteria\CriteriaInterface;
use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecorator;
use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecoratorTrait;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * UpdateBuilderDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\DML\PgsqlUpdateBuilder
*/
class UpdateBuilderDecorator extends SQLBuilderDecorator implements UpdateBuilderInterface
{
    /**
     * @var UpdateBuilderInterface
    */
    protected $builder;


    /**
     * @param UpdateBuilderInterface $builder
    */
    public function __construct(UpdateBuilderInterface $builder)
    {
        parent::__construct($builder);
    }



    /**
     * @inheritDoc
    */
    public function update(string $table): static
    {
        $this->builder->update($table);

        return $this;
    }
}
