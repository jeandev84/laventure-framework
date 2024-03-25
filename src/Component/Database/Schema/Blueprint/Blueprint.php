<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Schema\Blueprint\Column\BlueprintColumn;
use Laventure\Component\Database\Schema\Blueprint\Column\BlueprintColumnInterface;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * Blueprint (Table decorator)
 *
 * @inheritDoc
*/
class Blueprint implements BlueprintInterface
{
    /**
     * @param TableInterface $table
    */
    public function __construct(protected TableInterface $table)
    {

    }





    /**
     * @inheritDoc
    */
    public function increments(string $name): BlueprintColumnInterface
    {
        return $this->bigIncrements($name)->primary();
    }





    /**
     * @inheritDoc
    */
    public function id(): static
    {
        $this->increments('id');

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function bigIncrements(string $name): BlueprintColumnInterface
    {
        return new BlueprintColumn(
            $this->table,
            $this->table->bigIncrements($name)
        );
    }





    /**
     * @inheritDoc
     */
    public function integer(string $name, int $length = 11): BlueprintColumnInterface
    {
        // TODO: Implement integer() method.
    }

    /**
     * @inheritDoc
     */
    public function smallInteger(string $name): BlueprintColumnInterface
    {
        // TODO: Implement smallInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function bigInteger(string $name): BlueprintColumnInterface
    {
        // TODO: Implement bigInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumInteger(string $name): BlueprintColumnInterface
    {
        // TODO: Implement mediumInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyInteger(string $name): BlueprintColumnInterface
    {
        // TODO: Implement tinyInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function string(string $name, int $length = 255): BlueprintColumnInterface
    {
        // TODO: Implement string() method.
    }

    /**
     * @inheritDoc
     */
    public function char(string $name, $value): BlueprintColumnInterface
    {
        // TODO: Implement char() method.
    }

    /**
     * @inheritDoc
     */
    public function boolean(string $name): BlueprintColumnInterface
    {
        // TODO: Implement boolean() method.
    }

    /**
     * @inheritDoc
     */
    public function datetime(string $name): BlueprintColumnInterface
    {
        // TODO: Implement datetime() method.
    }

    /**
     * @inheritDoc
     */
    public function time(string $name): BlueprintColumnInterface
    {
        // TODO: Implement time() method.
    }

    /**
     * @inheritDoc
     */
    public function timestamp(string $name): BlueprintColumnInterface
    {
        // TODO: Implement timestamp() method.
    }

    /**
     * @inheritDoc
     */
    public function binary(string $name): BlueprintColumnInterface
    {
        // TODO: Implement binary() method.
    }

    /**
     * @inheritDoc
     */
    public function date(string $name): BlueprintColumnInterface
    {
        // TODO: Implement date() method.
    }

    /**
     * @inheritDoc
     */
    public function decimal(string $name, int $precision, int $scale): BlueprintColumnInterface
    {
        // TODO: Implement decimal() method.
    }

    /**
     * @inheritDoc
     */
    public function double(string $name, int $precision, int $scale): BlueprintColumnInterface
    {
        // TODO: Implement double() method.
    }

    /**
     * @inheritDoc
     */
    public function enum(string $name, array $values): BlueprintColumnInterface
    {
        // TODO: Implement enum() method.
    }

    /**
     * @inheritDoc
     */
    public function float(string $name): BlueprintColumnInterface
    {
        // TODO: Implement float() method.
    }

    /**
     * @inheritDoc
     */
    public function json(string $name): BlueprintColumnInterface
    {
        // TODO: Implement json() method.
    }

    /**
     * @inheritDoc
     */
    public function text(string $name): BlueprintColumnInterface
    {
        // TODO: Implement text() method.
    }

    /**
     * @inheritDoc
     */
    public function longText(string $name): BlueprintColumnInterface
    {
        // TODO: Implement longText() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumText(string $name): BlueprintColumnInterface
    {
        // TODO: Implement mediumText() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyText(string $name): BlueprintColumnInterface
    {
        // TODO: Implement tinyText() method.
    }

    /**
     * @inheritDoc
     */
    public function morphs(string $name): BlueprintColumnInterface
    {
        // TODO: Implement morphs() method.
    }

    /**
     * @inheritDoc
     */
    public function default($value): static
    {
        // TODO: Implement default() method.
    }

    /**
     * @inheritDoc
     */
    public function unsigned(): static
    {
        // TODO: Implement unsigned() method.
    }

    /**
     * @inheritDoc
     */
    public function timestamps(): static
    {
        // TODO: Implement timestamps() method.
    }

    /**
     * @inheritDoc
     */
    public function softDeletes(): static
    {
        // TODO: Implement softDeletes() method.
    }

    /**
     * @inheritDoc
     */
    public function nullableTimestamps(): static
    {
        // TODO: Implement nullableTimestamps() method.
    }

    /**
     * @inheritDoc
     */
    public function rememberToken(): static
    {
        // TODO: Implement rememberToken() method.
    }

    /**
     * @inheritDoc
     */
    public function primary(array $columns): static
    {
        // TODO: Implement primary() method.
    }

    /**
     * @inheritDoc
     */
    public function unique(array $columns): static
    {
        // TODO: Implement unique() method.
    }

    /**
     * @inheritDoc
     */
    public function index(array $columns): static
    {
        // TODO: Implement index() method.
    }

    /**
     * @inheritDoc
     */
    public function foreign(string $name): ForeignKeyInterface
    {
        // TODO: Implement foreign() method.
    }

    /**
     * @inheritDoc
     */
    public function foreignId(): ForeignKeyInterface
    {
        // TODO: Implement foreignId() method.
    }

    /**
     * @inheritDoc
     */
    public function addColumn(string $name, ColumnType|string $type, callable $options = null): static
    {
        // TODO: Implement addColumn() method.
    }

    /**
     * @inheritDoc
     */
    public function modifyColumn(string $name, callable $options = null): static
    {
        // TODO: Implement modifyColumn() method.
    }

    /**
     * @inheritDoc
     */
    public function renameColumn(string $name, string $to): static
    {
        // TODO: Implement renameColumn() method.
    }

    /**
     * @inheritDoc
     */
    public function dropColumn(string $name): static
    {
        // TODO: Implement dropColumn() method.
    }

    /**
     * @inheritDoc
     */
    public function createTable(): mixed
    {
        // TODO: Implement createTable() method.
    }

    /**
     * @inheritDoc
     */
    public function updateTable(): mixed
    {
        // TODO: Implement updateTable() method.
    }

    /**
     * @inheritDoc
     */
    public function dropTable(): mixed
    {
        // TODO: Implement dropTable() method.
    }

    /**
     * @inheritDoc
     */
    public function truncateTable(): mixed
    {
        // TODO: Implement truncateTable() method.
    }

    /**
     * @inheritDoc
     */
    public function renameTable(): mixed
    {
        // TODO: Implement renameTable() method.
    }

    /**
     * @inheritDoc
     */
    public function getTable(): TableInterface
    {
        // TODO: Implement getTable() method.
    }
}
