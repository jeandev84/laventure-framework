<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Common;

use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLQueryBuilderFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;

/**
 * AbstractSQLQueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers
*/
abstract class AbstractSQLQueryBuilder implements SQLQueryBuilderInterface
{
       /**
        * @var SQLQueryBuilderInterface
       */
       protected SQLQueryBuilderInterface $builder;


       /**
        * @param SQLQueryBuilderFactoryInterface $builderFactory
       */
       public function __construct(SQLQueryBuilderFactoryInterface $builderFactory)
       {
            $this->builder = $builderFactory->createSQLBuilder();
       }
}