<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\Factory;

use Laventure\Component\Database\Connection\Extensions\PDO\Connection;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\QueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLQueryBuilderFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;

/**
 * PdoSQLQueryBuilderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Query\Builder\Factory
*/
class PdoSQLQueryBuilderFactory implements SQLQueryBuilderFactoryInterface
{

    /**
     * @param Connection $connection
    */
    public function __construct(protected Connection $connection)
    {
    }




    /**
     * @inheritDoc
    */
    public function createBuilder(): SQLQueryBuilderInterface
    {
        return new QueryBuilder($this->connection);
    }
}