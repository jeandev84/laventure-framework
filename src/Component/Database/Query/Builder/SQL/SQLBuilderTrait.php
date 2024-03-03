<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Formatter\SQLFormatter;
use Laventure\Component\Database\Query\QueryInterface;
use Stringable;

/**
 * SqlBuilderTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Traits
 */
trait SQLBuilderTrait
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
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface
    {
        return $this->connection->statement($this->getSQL());
    }






    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getSQL();
    }




    /**
     * @return ConnectionInterface
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @return string
    */
    public function getSQL(): string
    {
        return (new SQLFormatter())
               ->addFormats($this->getCommands())
               ->format();
    }





    /**
     * @return Stringable[]
    */
    abstract protected function getCommands(): array;
}
