<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Oracle\Schema\Table;

use Laventure\Component\Database\Schema\Column\Factory\ColumnFactoryInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;
use Laventure\Component\Database\Schema\Table\Builder\TableSQlBuilderInterface;
use Laventure\Component\Database\Schema\Table\Table;

/**
 * OracleTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Drivers\Oracle\Table
*/
class OracleTable extends Table
{
    /**
     * @inheritDoc
     */
    protected function getColumnFactory(): ColumnFactoryInterface
    {
        // TODO: Implement getColumnFactory() method.
    }

    /**
     * @inheritDoc
     */
    public function getColumns(): array
    {
        // TODO: Implement getColumns() method.
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryKey(string $primaryKey): PrimaryKeyInterface
    {
        // TODO: Implement getPrimaryKey() method.
    }

    /**
     * @inheritDoc
     */
    public function dropPrimaryKey(string $primaryKey): static
    {
        // TODO: Implement dropPrimaryKey() method.
    }

    /**
     * @inheritDoc
     */
    public function dropPrimaryKeys(): static
    {
        // TODO: Implement dropPrimaryKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryKeys(): array
    {
        // TODO: Implement getPrimaryKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function getForeignKey(string $foreignKey): ForeignKeyInterface
    {
        // TODO: Implement getForeignKey() method.
    }

    /**
     * @inheritDoc
     */
    public function getForeignKeys(): array
    {
        // TODO: Implement getForeignKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function dropForeignKey(string $foreignKey): static
    {
        // TODO: Implement dropForeignKey() method.
    }

    /**
     * @inheritDoc
     */
    public function dropForeignKeys(): static
    {
        // TODO: Implement dropForeignKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function dropIndexes(): static
    {
        // TODO: Implement dropIndexes() method.
    }

    /**
     * @inheritDoc
     */
    public function dropIndex(string $index): static
    {
        // TODO: Implement dropIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function hasIndex(string $index): bool
    {
        // TODO: Implement hasIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function getIndex(string $index): IndexInterface
    {
        // TODO: Implement getIndex() method.
    }

    /**
     * @inheritDoc
     */
    public function getIndexes(): array
    {
        // TODO: Implement getIndexes() method.
    }

    /**
     * @inheritDoc
     */
    public function getUniqueKey(string $uniqueKey): UniqueKeyInterface
    {
        // TODO: Implement getUniqueKey() method.
    }

    /**
     * @inheritDoc
     */
    public function getUniqueKeys(): array
    {
        // TODO: Implement getUniqueKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function getConstraints(): array
    {
        // TODO: Implement getConstraints() method.
    }

    /**
     * @inheritDoc
     */
    public function dump(): mixed
    {
        // TODO: Implement dump() method.
    }

    /**
     * @inheritDoc
     */
    public function expr(): TableSQlBuilderInterface
    {
        // TODO: Implement expr() method.
    }
}
