<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Expr\Expr;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionInterface;
use Laventure\Component\Database\Query\Builder\SQL\Formatter\SQLFormatter;
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
     * @var array
     */
    protected array $parameters = [];





    /**
     * @var array
    */
    protected array $bindParams = [];




    /**
     * @var array
    */
    protected array $bindValues = [];





    /**
     * @var array
    */
    protected array $bindColumns = [];







    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }





    /**
     * @inheritdoc
    */
    public function setParameter($id, $value): static
    {
        $this->parameters[$id] = $value;

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function bindParam($id, $value, $type = null): static
    {
        $this->bindParams[$id] = [$id, $value, intval($type)];

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function bindValue($id, $value, $type = null): static
    {
        $this->bindValues[$id] = [$id, $value, intval($type)];

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function bindColumn($id, $value, $type = null): static
    {
        $this->bindColumns[$id] = [$id, $value, intval($type)];

        return $this;
    }





    /**
     * @param $id
     * @return mixed
    */
    public function getParameter($id): mixed
    {
        return $this->parameters[$id] ?? null;
    }






    /**
     * @param array $parameters
     * @return $this
    */
    public function setParameters(array $parameters): static
    {
        $this->parameters = array_merge(
            $this->parameters,
            $parameters
        );

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }





    /**
     * @inheritdoc
    */
    public function getQuery(): QueryInterface
    {
        $statement = $this->connection->statement($this->getSQL());
        $statement->setParameters($this->parameters);
        $statement->bindParams($this->bindParams);
        $statement->bindValues($this->bindValues);
        $statement->bindColumns($this->bindColumns);
        return $statement;
    }






    /**
     * @inheritdoc
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
        return (new SQLFormatter())
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
     * @inheritDoc
    */
    public function expr(): ExpressionInterface
    {
        return new Expr();
    }






    /**
     * @return Stringable[]
    */
    abstract protected function getCommands(): array;
}