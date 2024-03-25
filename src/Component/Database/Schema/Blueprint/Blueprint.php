<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Schema\Blueprint\Column\BlueprintColumn;
use Laventure\Component\Database\Schema\Blueprint\Column\BlueprintColumnInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Option\Contract\ColumnOptionInterface;
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
     * @var BlueprintColumnInterface[]
    */
    protected array $columns = [];




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
        return $this->column($this->table->bigIncrements($name));
    }





    /**
     * @inheritDoc
    */
    public function integer(string $name, int $length = 11): BlueprintColumnInterface
    {
        return $this->add($this->table->integer($name, $length));
    }





    /**
     * @inheritDoc
    */
    public function smallInteger(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->smallInteger($name));
    }





    /**
     * @inheritDoc
    */
    public function bigInteger(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->bigInteger($name));
    }






    /**
     * @inheritDoc
    */
    public function mediumInteger(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->mediumInteger($name));
    }






    /**
     * @inheritDoc
    */
    public function tinyInteger(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->tinyInteger($name));
    }






    /**
     * @inheritDoc
    */
    public function string(string $name, int $length = 255): BlueprintColumnInterface
    {
        return $this->add($this->table->string($name, $length));
    }





    /**
     * @inheritDoc
    */
    public function char(string $name, $value): BlueprintColumnInterface
    {
        return $this->add($this->table->char($name, $value));
    }






    /**
     * @inheritDoc
    */
    public function boolean(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->boolean($name));
    }





    /**
     * @inheritDoc
    */
    public function datetime(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->datetime($name));
    }





    /**
     * @inheritDoc
    */
    public function time(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->time($name));
    }





    /**
     * @inheritDoc
    */
    public function timestamp(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->timestamp($name));
    }





    /**
     * @inheritDoc
    */
    public function binary(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->binary($name));
    }





    /**
     * @inheritDoc
    */
    public function date(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->date($name));
    }






    /**
     * @inheritDoc
    */
    public function decimal(string $name, int $precision, int $scale): BlueprintColumnInterface
    {
        return $this->add($this->table->decimal($name, $precision, $scale));
    }






    /**
     * @inheritDoc
    */
    public function double(string $name, int $precision, int $scale): BlueprintColumnInterface
    {
        return $this->add($this->table->double($name, $precision, $scale));
    }





    /**
     * @inheritDoc
    */
    public function enum(string $name, array $values): BlueprintColumnInterface
    {
        return $this->add($this->table->enum($name, $values));
    }





    /**
     * @inheritDoc
    */
    public function float(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->float($name));
    }





    /**
     * @inheritDoc
    */
    public function json(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->json($name));
    }





    /**
     * @inheritDoc
    */
    public function text(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->text($name));
    }





    /**
     * @inheritDoc
    */
    public function longText(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->json($name));
    }




    /**
     * @inheritDoc
    */
    public function mediumText(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->mediumText($name));
    }





    /**
     * @inheritDoc
    */
    public function tinyText(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->tinyText($name));
    }






    /**
     * @inheritDoc
    */
    public function morphs(string $name): BlueprintColumnInterface
    {
        return $this->add($this->table->morphs($name));
    }





    /**
     * @inheritDoc
    */
    public function default($value): static
    {
        $this->table->default($value);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        $this->table->unsigned();

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function timestamps(): static
    {
        $this->table->addTimestamps();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function softDeletes(): static
    {
        $this->table->addSoftDeletes();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function nullableTimestamps(): static
    {
        $this->table->addNullableTimestamps();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function rememberToken(): static
    {
        $this->string('remember_token', 100)
             ->nullable();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function primary(array $columns): static
    {
        $this->table->addPrimaryKey($columns);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function unique(array $columns): static
    {
        $this->table->addUniqueKey($columns);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function index(array $columns): static
    {
        $this->table->addIndex($columns);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function foreign(string $name, callable $func): static
    {
        $this->table->addForeignKey($name, $func);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function foreignId(callable $func): static
    {
        return $this->foreign('id', $func);
    }





    /**
     * @inheritDoc
    */
    public function addColumn(string $name, ColumnType|string $type, callable $options = null): static
    {
        $this->table->addColumn($name, $type, $options);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function renameColumn(string $name, string $to): static
    {
        $this->table->renameColumn($name, $to);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function dropColumn(string $name): static
    {
        $this->table->dropColumn($name);

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function createTable(): mixed
    {
        return $this->table->create();
    }





    /**
     * @inheritDoc
    */
    public function updateTable(): mixed
    {
        return $this->table->update();
    }




    /**
     * @inheritDoc
    */
    public function dropTable(): mixed
    {
        return $this->table->update();
    }





    /**
     * @inheritDoc
    */
    public function truncateTable(): mixed
    {
        return $this->table->truncate();
    }






    /**
     * @inheritDoc
    */
    public function renameTable($name): mixed
    {
        return $this->table->rename($name);
    }






    /**
     * @inheritDoc
    */
    public function getColumns(): array
    {
        return $this->columns;
    }





    /**
     * @inheritDoc
    */
    public function table(): TableInterface
    {
        return $this->table;
    }





    /**
     * @param ColumnInterface $column
     * @return BlueprintColumnInterface
    */
    public function column(ColumnInterface $column): BlueprintColumnInterface
    {
        return new BlueprintColumn(
            $this->table,
            $column
        );
    }






    /**
     * @param ColumnInterface $column
     * @return BlueprintColumnInterface
    */
    private function add(ColumnInterface $column): BlueprintColumnInterface
    {
         return $this->columns[$column->getName()] = $this->column($column);
    }
}
