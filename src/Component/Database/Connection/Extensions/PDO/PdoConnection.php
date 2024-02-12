<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\NullConfiguration;
use Laventure\Component\Database\Connection\Connection;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\DatabaseInterface;
use Laventure\Component\Database\Query\Builder\QueryBuilderInterface;
use Laventure\Component\Database\Query\QueryInterface;
use PDO;

/**
 * PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO
*/
class PdoConnection extends Connection implements PdoConnectionInterface
{
     /**
      * @var PdoConnectionFactoryInterface
     */
     protected PdoConnectionFactoryInterface $connectionFactory;


     /**
      * @param PdoConnectionFactoryInterface $connectionFactory
     */
     public function __construct(PdoConnectionFactoryInterface $connectionFactory)
     {
         parent::__construct();
         $this->connectionFactory = $connectionFactory;
     }



     /**
      * @inheritDoc
     */
     public function connect(ConfigurationInterface $config): void
     {
         $pdo = $this->connectionFactory->makeConnection($config);
         $this->withConnection($pdo)
              ->withConfiguration($config);
     }



     /**
      * @inheritDoc
     */
     public function connected(): bool
     {
         return $this->connection instanceof PDO;
     }



     /**
      * @inheritDoc
     */
     public function disconnect(): void
     {
        $this->connection = null;
     }




     /**
      * @inheritDoc
     */
     public function purge(): void
     {
         $this->config = new NullConfiguration();
         $this->disconnect();
     }




    /**
     * @inheritDoc
    */
    public function disconnected(): bool
    {
        return is_null($this->connection);
    }



    /**
     * @inheritDoc
    */
    public function createQuery(): QueryInterface
    {

    }



    /**
     * @inheritDoc
     */
    public function statement(string $sql): QueryInterface
    {
        // TODO: Implement statement() method.
    }

    /**
     * @inheritDoc
     */
    public function executeQuery(string $sql): bool
    {
        // TODO: Implement executeQuery() method.
    }



    /**
     * @inheritDoc
     */
    public function beginTransaction(): bool
    {
        // TODO: Implement beginTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function hasActiveTransaction(): bool
    {
        // TODO: Implement hasActiveTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function commit(): bool
    {
        // TODO: Implement commit() method.
    }

    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        // TODO: Implement rollback() method.
    }




    /**
     * @inheritDoc
    */
    public function transaction(callable $func): mixed
    {

    }





    /**
     * @return PDO
    */
    public function getPdo(): PDO
    {
        return $this->getConnection();
    }
}