<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Delete;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecorator;
use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecoratorTrait;

/**
 * DeleteBuilderDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DML\MysqlDeleteBuilder
*/
class DeleteBuilderDecorator extends SQLBuilderDecorator implements DeleteBuilderInterface
{
    /**
     * @var DeleteBuilderInterface
    */
    protected $builder;




    /**
     * @param DeleteBuilderInterface $builder
    */
    public function __construct(DeleteBuilderInterface $builder)
    {
        parent::__construct($builder);
    }




    /**
     * @inheritDoc
    */
    public function delete(string $table): static
    {
        $this->builder->delete($table);

        return $this;
    }
}
