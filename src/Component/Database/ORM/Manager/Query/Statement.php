<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Query;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\Query\Logger\QueryLoggerInterface;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Query\Result\QueryResultInterface;

/**
 * Statement
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Statement
*/
class Statement implements QueryInterface
{


    /**
     * @param EntityManagerInterface $em
     * @param QueryInterface $statement
    */
    public function __construct(
        protected EntityManagerInterface $em,
        protected QueryInterface $statement
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function prepare(string $sql): static
    {
         $this->statement->prepare($sql);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function query(string $sql): static
    {
        $this->statement->query($sql);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function bindParam($param, $value, int $type = 0): static
    {
         $this->statement->bindParam($param, $value, $type);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function bindParams(array $params): static
    {
        $this->statement->bindParams($params);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function bindValue($param, $value, int $type = 0): static
    {
         $this->statement->bindValue($param, $value, $type);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function bindValues(array $values): static
    {
         $this->statement->bindValues($values);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function bindColumn($column, $value, int $type = 0): static
    {
        $this->statement->bindColumn($column, $value, $type);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function bindColumns(array $columns): static
    {
        $this->statement->bindColumns($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function setParameters(array $parameters): static
    {
         $this->statement->setParameters($parameters);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function setParameter($id, $value): static
    {
        $this->statement->setParameter($id, $value);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getParameter($id): mixed
    {
         return $this->statement->getParameter($id);
    }





    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
         return $this->statement->getParameters();
    }




    /**
     * @inheritDoc
    */
    public function execute(): bool
    {
        return $this->statement->execute();
    }





    /**
     * @inheritDoc
    */
    public function executeQuery(string $sql): int|false
    {
        return $this->statement->executeQuery($sql);
    }




    /**
     * @inheritDoc
    */
    public function lastInsertId(string $name = null): int
    {
        return $this->statement->lastInsertId($name);
    }




    /**
     * @inheritDoc
    */
    public function map(string $classname): static
    {
         $this->statement->map($classname);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function fetch(): QueryResultInterface
    {
        return new Result($this->em, $this->statement->fetch());
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return $this->statement->getSQL();
    }




    /**
     * @inheritDoc
    */
    public function setLogger(QueryLoggerInterface $logger): static
    {
        $this->statement->setLogger($logger);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getLogger(): QueryLoggerInterface
    {
        return $this->statement->getLogger();
    }
}