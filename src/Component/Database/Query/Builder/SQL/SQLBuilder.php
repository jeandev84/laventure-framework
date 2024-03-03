<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Formatter\QueryFormatter;
use Laventure\Component\Database\Query\QueryInterface;
use Stringable;

/**
 * SQLBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL
*/
abstract class SQLBuilder implements SQLBuilderInterface
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;



    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }






    /**
     * @inheritDoc
    */
    public function bindParam($id, $value, $type = null): static
    {
        return $this;
    }





    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
        return $this;
    }




    /**
     * @inheritDoc
   */
    public function getParameter($id): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        // TODO: Implement getParameters() method.
    }




    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface
    {
        return $this->connection->statement($this->getSQL());
    }






    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @inheritdoc
    */
    public function getSQL(): string
    {
        return (new QueryFormatter())
               ->addFormats($this->getCommands())
               ->format();
    }







    /**
     * @inheritdoc
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }








    /**
     * @return Stringable[]
    */
    abstract protected function getCommands(): array;
}