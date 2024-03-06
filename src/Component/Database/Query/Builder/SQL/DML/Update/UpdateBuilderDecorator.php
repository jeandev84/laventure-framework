<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Update;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Decorator\SQLBuilderDecoratorTrait;

/**
 * UpdateBuilderDecorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DML\Update
*/
class UpdateBuilderDecorator extends UpdateBuilder
{
       use SQLBuilderDecoratorTrait;


       /**
        * @var UpdateBuilderInterface
       */
       protected $builder;



       /**
        * @param UpdateBuilderInterface $builder
       */
       public function __construct(UpdateBuilderInterface $builder)
       {
           parent::__construct($builder->getConnection());
       }




       /**
        * @param $column
        * @param $value
        * @return $this
       */
       public function set($column, $value): static
       {
           $this->builder->set($column, $value);

           return $this;
       }
}