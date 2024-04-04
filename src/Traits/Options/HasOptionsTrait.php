<?php

declare(strict_types=1);

namespace Laventure\Traits\Options;

/**
 * HasOptionsTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Traits\Options
*/
trait HasOptionsTrait
{
    /**
     * @var array
    */
    protected array $options = [];






    /**
     * @return array
    */
    public function getOptions(): array
    {
        return $this->options;
    }






    /**
     * @param $key
     * @param $default
     * @return mixed
    */
    public function getOption($key, $default = null): mixed
    {
        return $this->options[$key] ?? $default;
    }





    /**
     * @param array $options
     * @return $this
    */
    public function options(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }
}
