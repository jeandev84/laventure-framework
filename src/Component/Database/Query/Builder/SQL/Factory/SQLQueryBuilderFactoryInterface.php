<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Factory;


use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;

/**
 * SQLQueryBuilderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Factory
*/
interface SQLQueryBuilderFactoryInterface
{

     /**
      * @return SQLQueryBuilderInterface
     */
     public function createSQLBuilder(): SQLQueryBuilderInterface;
}