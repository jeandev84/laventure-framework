<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Sqlite\Schema\Table;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Table\Table;

/**
 * SqliteTable
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Drivers\Sqlite
*/
class SqliteTable extends Table
{
    /**
     * @inheritDoc
     */
    public function foreignKeyChecks(callable $func): mixed
    {
        // TODO: Implement foreignKeyChecks() method.
    }

    /**
     * @inheritDoc
     */
    public function create(): bool
    {
        // TODO: Implement create() method.
    }

    /**
     * @inheritDoc
     */
    public function column(string $name, string $type = '', string $constraints = ''): ColumnInterface
    {
        // TODO: Implement column() method.
    }

    /**
     * @inheritDoc
     */
    public function increments(string $name): static
    {
        // TODO: Implement increments() method.
    }

    /**
     * @inheritDoc
     */
    public function bigIncrements(string $name): ColumnInterface
    {
        // TODO: Implement bigIncrements() method.
    }

    /**
     * @inheritDoc
     */
    public function integer(string $name, int $length = 11): ColumnInterface
    {
        // TODO: Implement integer() method.
    }

    /**
     * @inheritDoc
     */
    public function smallInteger(string $name): ColumnInterface
    {
        // TODO: Implement smallInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function bigInteger(string $name): ColumnInterface
    {
        // TODO: Implement bigInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumInteger(string $name): ColumnInterface
    {
        // TODO: Implement mediumInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyInteger(string $name): ColumnInterface
    {
        // TODO: Implement tinyInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function char(string $name, $value): ColumnInterface
    {
        // TODO: Implement char() method.
    }

    /**
     * @inheritDoc
     */
    public function datetime(string $name): ColumnInterface
    {
        // TODO: Implement datetime() method.
    }

    /**
     * @inheritDoc
     */
    public function time(string $name): ColumnInterface
    {
        // TODO: Implement time() method.
    }

    /**
     * @inheritDoc
     */
    public function timestamp(string $name): ColumnInterface
    {
        // TODO: Implement timestamp() method.
    }

    /**
     * @inheritDoc
     */
    public function binary(string $name): ColumnInterface
    {
        // TODO: Implement binary() method.
    }

    /**
     * @inheritDoc
     */
    public function date(string $name): ColumnInterface
    {
        // TODO: Implement date() method.
    }

    /**
     * @inheritDoc
     */
    public function decimal(string $name, int $precision, int $scale): ColumnInterface
    {
        // TODO: Implement decimal() method.
    }

    /**
     * @inheritDoc
     */
    public function double(string $name, int $precision, int $scale): ColumnInterface
    {
        // TODO: Implement double() method.
    }

    /**
     * @inheritDoc
     */
    public function enum(string $name, array $values): ColumnInterface
    {
        // TODO: Implement enum() method.
    }

    /**
     * @inheritDoc
     */
    public function float(string $name): ColumnInterface
    {
        // TODO: Implement float() method.
    }

    /**
     * @inheritDoc
     */
    public function json(string $name): ColumnInterface
    {
        // TODO: Implement json() method.
    }

    /**
     * @inheritDoc
     */
    public function longText(string $name): ColumnInterface
    {
        // TODO: Implement longText() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumText(string $name): ColumnInterface
    {
        // TODO: Implement mediumText() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyText(string $name): ColumnInterface
    {
        // TODO: Implement tinyText() method.
    }

    /**
     * @inheritDoc
     */
    public function morphs(string $name): ColumnInterface
    {
        // TODO: Implement morphs() method.
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
    public function getColumnsInfo(): array
    {
        // TODO: Implement getColumnsInfo() method.
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
    public function getForeignKeys(): array
    {
        // TODO: Implement getForeignKeys() method.
    }

    /**
     * @inheritDoc
     */
    public function dropForeignKeys(): mixed
    {
        // TODO: Implement dropForeignKeys() method.
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
    public function getUniques(): array
    {
        // TODO: Implement getUniques() method.
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
    public function listConstraints(): array
    {
        // TODO: Implement listConstraints() method.
    }
}
