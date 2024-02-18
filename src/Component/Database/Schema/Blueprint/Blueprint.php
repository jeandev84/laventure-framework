<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * Blueprint (Decorator TableInterface)
 *
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint
*/
class Blueprint
{
    /**
     * @param TableInterface $table
    */
    public function __construct(protected TableInterface $table)
    {

    }






    /**
     * @param string $name
     * @param string $type
     * @return ColumnInterface
    */
    public function addColumn(string $name, string $type): ColumnInterface
    {
        return $this->table->addColumn($name, $type);
    }







    /**
     * @param string $name
     * @return TableInterface
    */
    public function dropColumn(string $name): TableInterface
    {
        return $this->table->dropColumn($name);
    }





    /**
     * @param string $name
     * @param string $to
     * @return TableInterface
    */
    public function renameColumn(string $name, string $to): TableInterface
    {
        return $this->table->renameColumn($name, $to);
    }





    /**
     * @param string $name
     * @return TableInterface
    */
    public function increments(string $name): TableInterface
    {
        return $this->table->increments($name);
    }





    /**
     * @return TableInterface
    */
    public function id(): TableInterface
    {
        return $this->increments('id');
    }






    /**
     * @param string $name
     * @param int $length
     * @return ColumnInterface
    */
    public function string(string $name, int $length = 255): ColumnInterface
    {
        return $this->table->string($name, $length);
    }






    /**
     * @param $name
     * @return ColumnInterface
    */
    public function datetime($name): ColumnInterface
    {
        return $this->table->datetime($name);
    }




    /**
     * Add column type default
     *
     * @param $value
     *
     * @return mixed
    */
    public function default($value): static
    {
        foreach ($this->table->getColumns() as $column) {
            $this->table->add($column->default($value));
        }

        return $this;
    }







    /**
     * Add column type timestamp
     *
     * @return $this
    */
    public function unsigned(): static
    {
        foreach ($this->table->getColumns() as $column) {
            $this->table->add($column->unsigned());
        }

        return $this;
    }





    /**
     * @return $this
    */
    public function timestamps(): static
    {
        $this->datetime('created_at');
        $this->datetime('updated_at')->nullable();;

        return $this;
    }





    /**
     * Add Nullable timestamps
    */
    public function nullableTimestamps(): static
    {
        $this->datetime('created_at')->nullable();
        $this->datetime('updated_at')->nullable();

        return $this;
    }





    /**
     * @return $this
    */
    public function softDeletes(): static
    {
        $this->table->datetime('deleted_at')
                    ->nullable();

        return $this;
    }






    /**
     * @return $this
    */
    public function rememberToken(): static
    {
          $this->string('remember_token', 100)
               ->nullable();

          return $this;
    }






    /**
     * @param array $columns
     * @return static
    */
    public function primary(array $columns): static
    {
        $this->table->primary($columns);

        return $this;
    }





    /**
     * @param array $columns
     * @return $this
    */
    public function unique(array $columns): static
    {
        $this->table->unique($columns);

        return $this;
    }




    /**
     * @param array$columns
     * @return $this
    */
    public function index(array $columns): static
    {
         $this->table->index($columns);

         return $this;
    }






    /**
     * @param string $name
     * @return ForeignKeyInterface
    */
    public function foreign(string $name): ForeignKeyInterface
    {
        return $this->table->foreign($name);
    }





    /**
     * @return ForeignKeyInterface
    */
    public function foreignId(): ForeignKeyInterface
    {
        return $this->foreign('id');
    }





    /**
     * @return mixed
    */
    public function dropIfExists(): bool
    {
        return $this->table->dropIfExists();
    }





    /**
     * @return mixed
    */
    public function truncate(): bool
    {
        return $this->table->truncate();
    }





    /**
     * @return bool
    */
    public function truncateCascade(): mixed
    {
        return $this->table->truncateCascade();
    }




    /**
     * @return bool
    */
    public function existTable(): bool
    {
        return $this->table->exists();
    }




    /**
     * @return array
    */
    public function getTables(): array
    {
        return $this->table->list();
    }




    /**
     * @return string
    */
    public function getTableName(): string
    {
        return $this->table->getName();
    }




    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function bigIncrements(string $name): ColumnInterface
    {
        return $this->table->bigIncrements($name);
    }




    /**
     * @param string $name
     * @param int $length
     * @return ColumnInterface
    */
    public function integer(string $name, int $length = 11): ColumnInterface
    {
        return $this->table->integer($name, $length);
    }





    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function smallInteger(string $name): ColumnInterface
    {
        return $this->table->smallInteger($name);
    }




    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function bigInteger(string $name): ColumnInterface
    {
        return $this->table->bigInteger($name);
    }





    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function mediumInteger(string $name): ColumnInterface
    {
        return $this->table->mediumInteger($name);
    }





    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function tinyInteger(string $name): ColumnInterface
    {
        return $this->tinyInteger($name);
    }




    /**
     * @param string $name
     * @param $value
     * @return ColumnInterface
    */
    public function char(string $name, $value): ColumnInterface
    {
        return $this->table->char($name, $value);
    }





    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function boolean(string $name): ColumnInterface
    {
        return $this->table->boolean($name);
    }




    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function time(string $name): ColumnInterface
    {
        return $this->table->time($name);
    }







    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function timestamp(string $name): ColumnInterface
    {
        return $this->table->timestamp($name);
    }






    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function binary(string $name): ColumnInterface
    {
        return $this->table->binary($name);
    }




    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function date(string $name): ColumnInterface
    {
        return $this->table->date($name);
    }




    /**
     * @param string $name
     * @param int $precision
     * @param int $scale
     * @return ColumnInterface
    */
    public function decimal(string $name, int $precision, int $scale): ColumnInterface
    {
        return $this->table->decimal($name, $precision, $scale);
    }








    /**
     * @param string $name
     * @param int $precision
     * @param int $scale
     * @return ColumnInterface
    */
    public function double(string $name, int $precision, int $scale): ColumnInterface
    {
        return $this->table->double($name, $precision, $scale);
    }





    /**
     * @param string $name
     * @param array $values
     * @return ColumnInterface
    */
    public function enum(string $name, array $values): ColumnInterface
    {
        return $this->table->enum($name, $values);
    }





    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function float(string $name): ColumnInterface
    {
        return $this->table->float($name);
    }






    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function json(string $name): ColumnInterface
    {
        return $this->table->json($name);
    }







    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function text(string $name): ColumnInterface
    {
        return $this->table->text($name);
    }




    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function longText(string $name): ColumnInterface
    {
        return $this->table->longText($name);
    }




    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function mediumText(string $name): ColumnInterface
    {
        return $this->table->mediumText($name);
    }






    /**
     * @param string $name
     * @return ColumnInterface
    */
    public function morphs(string $name): ColumnInterface
    {
        return $this->table->morphs($name);
    }





    /**
     * @param string $sql
     * @return mixed
    */
    public function exec(string $sql): bool
    {
        return $this->table->exec($sql);
    }




    /**
     * @return array
    */
    public function getColumnsInfo(): array
    {
        return $this->table->getColumnsInfo();
    }




    /**
     * @param string $name
     * @return bool
    */
    public function hasColumn(string $name): bool
    {
        return $this->table->hasColumn($name);
    }





    /**
     * @return ColumnInterface[]
    */
    public function getColumns(): array
    {
        return $this->table->getColumns();
    }




    /**
     * @return TableCriteriaInterface
    */
    public function getCriteria(): TableCriteriaInterface
    {
        return $this->table->getCriteria();
    }





    /**
     * @return bool
    */
    public function create(): bool
    {
        return $this->table->create();
    }






    /**
     * @return bool
    */
    public function update(): bool
    {
        return $this->table->update();
    }






    /**
     * @return mixed
    */
    public function drop(): mixed
    {
        return $this->table->drop();
    }









    /**
     * @return TableInterface
    */
    public function getTable(): TableInterface
    {
        return $this->table;
    }
}
