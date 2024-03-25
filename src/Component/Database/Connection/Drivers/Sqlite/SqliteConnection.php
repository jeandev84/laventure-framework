<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Sqlite;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Drivers\Sqlite\Schema\Table\SqliteTable;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\Connection\Name\ConnectionName;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Query\Builder\SQL\SQLQueryBuilderInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * SqliteConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Sqlite
*/
class SqliteConnection extends PdoConnection
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionName::Sqlite;
    }




    /**
     * @inheritDoc
    */
    public function createQueryBuilder(): SQLQueryBuilderInterface
    {
        return new SqliteQueryBuilder($this->createPdoQueryBuilder());
    }




    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new SqliteDatabase($this);
    }





    /**
     * @inheritDoc
    */
    public function table(string $name, string $schemaName = ''): TableInterface
    {
        return new SqliteTable($this, $name, $schemaName);
    }




    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    protected function makeDefaultDsn(ConfigurationInterface $config): string
    {
        return $this->makeSQLiteDsn($config);
    }




    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    protected function makeDsnIfDatabaseExists(ConfigurationInterface $config): string
    {
        return $this->makeSQLiteDsn($config);
    }





    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    private function makeSQLiteDsn(ConfigurationInterface $config): string
    {
        return sprintf('%s:%s', $config->required('driver'), $config->getDatabase());
    }
}
