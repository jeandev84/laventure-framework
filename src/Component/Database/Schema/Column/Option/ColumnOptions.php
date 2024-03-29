<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Option;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Option\Contract\ColumnOptionInterface;

/**
 * ColumnOptions
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Option
*/
class ColumnOptions implements ColumnOptionInterface
{
    /**
     * @var array
    */
    protected array $params = [];



    /**
     * @param ColumnInterface $column
    */
    public function __construct(
        protected ColumnInterface $column
    ) {
    }







    /**
     * @inheritDoc
    */
    public function primary(): static
    {
        $this->column->primary();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function increment(): static
    {
        $this->column->increments();

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function unique(): static
    {
        $this->column->unique();

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function default($value): static
    {
        $this->column->default($value);

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function notNull(): static
    {
        $this->column->notNull();

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function nullable(): static
    {
        $this->column->nullable();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function signed(): static
    {
        $this->column->signed();

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        $this->column->unsigned();

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function precision(int $precision): static
    {
        return $this->params(compact('precision'));
    }





    /**
     * @inheritDoc
    */
    public function scale(int $scale): static
    {
        return $this->params(compact('scale'));
    }





    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        return $this->params(compact('values'));
    }






    /**
     * @inheritDoc
    */
    public function length(int $length): static
    {
        return $this->params(compact('length'));
    }





    /**
     * @inheritDoc
    */
    public function params(array $params): static
    {
        $this->params = array_merge(
            $this->params,
            $params
        );

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getParams(): array
    {
        return $this->params;
    }







    /**
     * @inheritDoc
    */
    public function call(callable $func): static
    {
        call_user_func($func, $this);

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function callMethod(string $method): static
    {
        if (method_exists($this->column, $method)) {
            call_user_func_array([$this->column, $method], $this->getParams());
        }

        return $this;
    }






    /**
     * @return ColumnInterface
    */
    public function getColumn(): ColumnInterface
    {
        return $this->column;
    }
}
