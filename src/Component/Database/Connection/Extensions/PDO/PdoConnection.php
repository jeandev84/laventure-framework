<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\NullConfiguration;
use Laventure\Component\Database\Connection\Connection;
use Laventure\Component\Database\Connection\Extensions\PDO\Config\Resolver\PdoConfigurationResolver;
use Laventure\Component\Database\Connection\Extensions\PDO\Factory\PdoConnectionFactoryInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Query\Query;
use Laventure\Component\Database\Query\QueryInterface;
use PDO;
use PDOException;

/**
 * PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO
*/
abstract class PdoConnection extends Connection implements PdoConnectionInterface
{
     /**
      * @var PdoConnectionFactoryInterface
     */
     protected PdoConnectionFactoryInterface $factory;


     /**
      * @var PdoConfigurationResolver
     */
     protected PdoConfigurationResolver $resolver;


     /**
      * @param PdoConnectionFactoryInterface $factory
     */
     public function __construct(PdoConnectionFactoryInterface $factory)
     {
         parent::__construct();
         $this->factory  = $factory;
         $this->resolver = new PdoConfigurationResolver($this->getName());
     }



     /**
      * @inheritDoc
     */
     public function connect(ConfigurationInterface $config): void
     {
         $config = $this->resolver->resolve($config);
         $this->withConnection($this->makeConnection($config))
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
         $this->withConfiguration(new NullConfiguration())
              ->disconnect();
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
       return new Query($this->getPdo());
    }





    /**
     * @inheritDoc
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->createQuery()->prepare($sql);
    }




    /**
     * @inheritDoc
    */
    public function executeQuery(string $sql): bool
    {
        return $this->createQuery()->exec($sql);
    }





    /**
     * @inheritDoc
    */
    public function beginTransaction(): bool
    {
        return $this->getPdo()->beginTransaction();
    }




    /**
     * @inheritDoc
    */
    public function hasActiveTransaction(): bool
    {
        return $this->getPdo()->inTransaction();
    }






    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
       return $this->getPdo()->commit();
    }






    /**
     * @inheritDoc
    */
    public function rollback(): bool
    {
        return $this->getPdo()->rollBack();
    }






    /**
     * @inheritDoc
    */
    public function transaction(callable $func): bool
    {
        try {

            $this->beginTransaction();
            $func($this);
            return $this->commit();

        } catch (PDOException $e) {

            if ($this->hasActiveTransaction()) {
                $this->rollBack();
            }

            throw new PDOException($e->getMessage(), $e->getCode());
        }
    }





    /**
     * @return PDO
    */
    public function getPdo(): PDO
    {
        return $this->getConnection();
    }



    /**
     * @param ConfigurationInterface $config
     * @return PDO
    */
    public function makeConnection(ConfigurationInterface $config): PDO
    {
        return $this->factory->makeConnection($config);
    }
}