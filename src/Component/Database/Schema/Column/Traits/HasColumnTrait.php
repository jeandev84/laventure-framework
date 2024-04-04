<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Traits;

/**
 * HasColumnTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Traits
*/
trait HasColumnTrait
{
    /**
     * @var array
    */
    protected array $columns = [];



    /**
     * @param array $columns
     * @return $this
    */
    public function withColumns(array $columns): static
    {
        $this->columns = array_merge($this->columns, $columns);

        return $this;
    }




    /**
     * Returns columns
     *
     * @return array
    */
    public function getColumns(): array
    {
        return $this->columns;
    }




    /**
     * @return bool
    */
    public function hasColumns(): bool
    {
        return !empty($this->columns);
    }





    /**
     * @param $key
     * @param $default
     * @return string
    */
    public function getColumn($key, $default = null): string
    {
        return $this->columns[$key] ?? $default;
    }






    /**
     * @return string
    */
    public function getColumnsAsString(): string
    {
        return join(',', $this->getColumns());
    }





    /**
     * @return string
    */
    public function wrapColumns(): string
    {
        return "(". $this->getColumnsAsString() . ")";
    }




    /**
     * @return string
    */
    public function wrapColumnsIf(): string
    {
        return ($this->hasColumns() ? $this->wrapColumns() : '');
    }
}
