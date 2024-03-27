<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Null\NullConfiguration;
use Laventure\Component\Database\Connection\Connection;
use Laventure\Component\Database\Connection\ConnectionTrait;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Factory\MysqliConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Factory\MysqliConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Query\Query;
use Laventure\Component\Database\Connection\Factory\ConnectionFactoryInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Drivers\DriverName;
use Laventure\Component\Database\Drivers\Mysql\Connection\MysqlConnection;
use Laventure\Component\Database\Drivers\Mysql\MysqlDatabase;
use Laventure\Component\Database\Drivers\Mysql\Schema\Table\MysqlTable;
use Laventure\Component\Database\Query\Builder\SQL\Factory\SQLQueryBuilderFactoryInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilder;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;
use mysqli;

/**
 * MysqliConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\Mysqli
*/
class MysqliConnection extends Connection implements MysqliConnectionInterface
{


    public function __construct(MysqliConnectionFactoryInterface $factory = null)
    {
        parent::__construct($factory ?: new MysqliConnectionFactory());
    }




    /**
     * @inheritDoc
    */
    public function connected(): bool
    {
        return $this->connection instanceof mysqli;
    }
}
