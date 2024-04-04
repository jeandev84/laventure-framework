<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;

/**
 * Column
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Option
*/
class Column
{

    /**
     * @param ColumnInterface $column
    */
    public function __construct(
        protected ColumnInterface $column
    ) {
    }




    /**
     * @param int $length
     * @return $this
    */
    public function string(int $length = 255): static
    {
        $this->column->string($length);

        return $this;
    }





    /**
     * @return $this
    */
    public function primary(): static
    {
        $this->column->primary();

        return $this;
    }





    /**
     * @return $this
    */
    public function increments(): static
    {
        $this->column->increments();

        return $this;
    }





    /**
     * @return $this
    */
    public function unique(): static
    {
        $this->column->unique();

        return $this;
    }


    /**
     * @param $value
     * @return $this
    */
    public function default($value): static
    {
        $this->column->default($value);

        return $this;
    }




    /**
     * @return $this
    */
    public function notNull(): static
    {
        $this->column->notNull();

        return $this;
    }





    /**
     * @return $this
    */
    public function nullable(): static
    {
        $this->column->nullable();

        return $this;
    }




    /**
     * @return $this
    */
    public function signed(): static
    {
        $this->column->signed();

        return $this;
    }





    /**
     * @return $this
    */
    public function unsigned(): static
    {
        $this->column->unsigned();

        return $this;
    }




    /**
     * @return $this
    */
    public function bigIncrements(): static
    {
        $this->column->bigIncrements();

        return $this;
    }




    /**
     * @param int $length
     * @return $this
    */
    public function integer(int $length = 11): static
    {
        $this->column->integer($length);

        return $this;
    }




    /**
     * @return $this
    */
    public function smallInteger(): static
    {
        $this->column->smallInteger();

        return $this;
    }





    /**
     * @return $this
    */
    public function bigInteger(): static
    {
        $this->column->bigInteger();

        return $this;
    }





    /**
     * @return $this
    */
    public function mediumInteger(): static
    {
        $this->column->mediumInteger();

        return $this;
    }






    /**
     * @return $this
    */
    public function tinyInteger(): static
    {
        $this->column->tinyInteger();

        return $this;
    }




    /**
     * @param $value
     * @return $this
    */
    public function char($value): static
    {
        $this->column->char($value);

        return $this;
    }





    /**
     * @return $this
    */
    public function boolean(): static
    {
        $this->column->boolean();

        return $this;
    }





    /**
     * @return $this
    */
    public function datetime(): static
    {
        $this->column->datetime();

        return $this;
    }





    /**
     * @return $this
    */
    public function time(): static
    {
        $this->column->time();

        return $this;
    }






    /**
     * @return $this
    */
    public function timestamp(): static
    {
        $this->column->timestamp();

        return $this;
    }






    /**
     * @return $this
    */
    public function binary(): static
    {
        $this->column->binary();

        return $this;
    }






    /**
     * @return $this
    */
    public function date(): static
    {
        $this->column->date();

        return $this;
    }





    /**
     * @param int $precision
     * @param int $scale
     * @return $this
    */
    public function decimal(int $precision, int $scale): static
    {
        $this->column->decimal($precision, $scale);

        return $this;
    }






    /**
     * @param int $precision
     * @param int $scale
     * @return $this
    */
    public function double(int $precision, int $scale): static
    {
        $this->column->decimal($precision, $scale);

        return $this;
    }







    /**
     * @param array $values
     * @return $this
    */
    public function enum(array $values): static
    {
        $this->column->enum($values);

        return $this;
    }







    /**
     * @return $this
    */
    public function float(): static
    {
        $this->column->float();

        return $this;
    }






    /**
     * @return $this
    */
    public function json(): static
    {
        $this->column->json();

        return $this;
    }






    /**
     * @return $this
    */
    public function text(): static
    {
        $this->column->text();

        return $this;
    }







    /**
     * @return $this
    */
    public function longText(): static
    {
        $this->column->longText();

        return $this;
    }







    /**
     * @return $this
    */
    public function mediumText(): static
    {
        $this->column->mediumText();

        return $this;
    }







    /**
     * @return $this
    */
    public function tinyText(): static
    {
        $this->column->tinyText();

        return $this;
    }






    /**
     * @return $this
    */
    public function morphs(): static
    {
        $this->column->morphs();

        return $this;
    }
}
