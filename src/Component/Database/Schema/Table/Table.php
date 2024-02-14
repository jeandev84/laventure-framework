<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Schema\Column\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueInterface;
use Laventure\Component\Database\Schema\Constraints\Types\Index;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Unique;
use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Table\Exceptions\TableException;

/**
 * Table
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table
*/
abstract class Table implements TableInterface
{
    /**
     * @var ColumnInterface[]
    */
    protected array $columns = [];



    /**
     * @var ColumnInterface[]
    */
    protected array $renameColumns = [];




    /**
     * @var ColumnInterface[]
    */
    protected array $dropColumns = [];





    /**
     * @var ConstraintInterface[]
    */
    protected array $constraints = [];





    /**
     * @param ConnectionInterface $connection
     * @param string $name
    */
    public function __construct(
        protected ConnectionInterface $connection,
        protected string $name
    ) {
    }





    /**
     * @inheritDoc
    */
    public function addColumn(string $name, string $type, string $constraints = ''): ColumnInterface
    {
        return $this->add($this->column($name, $type, $constraints));
    }





    /**
     * @inheritDoc
    */
    public function renameColumn(string $name, string $to): static
    {
        $this->renameColumns[$name] = $this->column($name)
                                           ->rename($to)
                                           ->getSQL();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function dropColumn(string $name): static
    {
        $this->dropColumns[$name] = $this->column($name)
                                         ->drop()
                                         ->getSQL();

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function primary(array $columns): static
    {
        $this->addPrimaryKey(new PrimaryKey($columns));

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function unique(array $columns): static
    {
        $this->addUnique(new Unique($columns));

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function index(array $columns): static
    {
        $this->addIndex(new Index($columns));

        return $this;
    }






    /**
     * @inheritdoc
    */
    public function add(ColumnInterface $column): ColumnInterface
    {
        return $this->columns[$column->getName()] = $column;
    }






    /**
     * @inheritDoc
    */
    public function addConstraint(ConstraintInterface $constraint): ConstraintInterface
    {
        return $this->constraints[] = $constraint;
    }





    /**
     * @inheritDoc
    */
    public function addPrimaryKey(PrimaryKeyInterface $primaryKey): PrimaryKeyInterface
    {
        $this->addConstraint($primaryKey);

        return $primaryKey;
    }






    /**
     * @inheritDoc
    */
    public function addForeignKey(ForeignKeyInterface $foreignKey): ForeignKeyInterface
    {
        $this->addConstraint($foreignKey);

        return $foreignKey;
    }






    /**
     * @inheritDoc
    */
    public function addIndex(IndexInterface $index): IndexInterface
    {
        $this->addConstraint($index);

        return $index;
    }





    /**
     * @inheritDoc
    */
    public function addUnique(UniqueInterface $unique): UniqueInterface
    {
        $this->addConstraint($unique);

        return $unique;
    }






    /**
     * @inheritDoc
    */
    public function addTimestamps(): static
    {
        $this->datetime('created_at');
        $this->datetime('updated_at');

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function addTimestampsNullable(): static
    {
        $this->datetime('created_at')->nullable();
        $this->datetime('updated_at')->nullable();

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addSoftDeletesTimestamps(): static
    {
        $this->datetime('deleted_at')->nullable();

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function string(string $name, int $length = 255): ColumnInterface
    {
        return $this->addColumn($name, "VARCHAR($length)");
    }





    /**
     * @inheritdoc
    */
    public function boolean(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'BOOLEAN');
    }





    /**
     * Support text to 65 kb
     *
     * @inheritdoc
    */
    public function text(string $name): ColumnInterface
    {
        return $this->addColumn($name, 'TEXT');
    }




    /**
     * @param string $table
     * @return string
    */
    public function foreignKeyName(string $table): string
    {
        $key  = md5(uniqid("{$this->name}_{$table}"));

        return sprintf('fk_%s', substr($key, 0, 12));
    }





    /**
     * @inheritDoc
     */
    public function hasColumn(string $name): bool
    {
        return in_array($name, $this->getColumns());
    }





    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @inheritDoc
     */
    public function exists(): bool
    {
        return in_array($this->getName(), $this->list());
    }





    /**
     * @inheritDoc
     */
    public function list(): array
    {
        return $this->connection->getDatabase()->getSchemas();
    }





    /**
     * @inheritDoc
    */
    public function exec(string $sql): mixed
    {
        return $this->connection->executeQuery($sql);
    }





    /**
     * @inheritDoc
    */
    public function statement(string $sql): QueryInterface
    {
        return $this->connection->statement($sql);
    }







    /**
     * @inheritDoc
    */
    public function update(): bool
    {
        return $this->exec(
            sprintf('ALTER TABLE %s %s;', $this->name, $this->updateCriteria())
        );
    }






    /**
     * @inheritDoc
     */
    public function drop(): bool
    {
        $this->exec(sprintf('DROP TABLE %s', $this->getName()));

        return $this->exists();
    }





    /**
     * @inheritDoc
     */
    public function dropIfExists(): bool
    {
        $this->exec(sprintf('DROP TABLE IF EXISTS %s;', $this->getName()));

        return $this->exists();
    }




    /**
     * @inheritDoc
     */
    public function truncate(): bool
    {
        return $this->exec(sprintf('TRUNCATE TABLE %s;', $this->getName()));
    }




    /**
     * @inheritDoc
    */
    public function truncateCascade(): bool
    {
        return $this->exec(sprintf('TRUNCATE TABLE CASCADE %s;', $this->getName()));
    }





    /**
     * @inheritdoc
    */
    public function createCriteria(): string
    {
        $criteria = join(', ', array_filter([
            join(', ', array_values($this->columns)),
            join(', ', array_values($this->constraints))
        ]));

        if (!$criteria) {
            throw new TableException("empty criteria from (". __METHOD__ . ")");
        }

        return $criteria;
    }






    /**
     * @inheritdoc
    */
    public function updateCriteria(): string
    {
        $criteria = join(', ', array_filter([
            join(', ', $this->getUpdateColumns()),
            join(', ', array_values($this->dropColumns)),
            join(', ', array_values($this->renameColumns))
        ]));

        if (!$criteria) {
            throw new TableException("empty criteria from : (". __METHOD__ . ")");
        }

        return $criteria;
    }





    /**
     * @return array
    */
    protected function getUpdateColumns(): array
    {
        $resolved = [];

        foreach ($this->columns as $column) {
           $resolved[] = $column->add()->getSQL();
        }

        return $resolved;
    }







    /**
     * @inheritdoc
    */
    abstract public function create(): bool;




    /**
     * Create new instance of table column
     *
     * @param string $name
     * @param string $type
     * @param string $constraints
     * @return ColumnInterface
    */
    abstract public function column(string $name, string $type = '', string $constraints = ''): ColumnInterface;
}
