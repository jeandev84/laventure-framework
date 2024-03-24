<?php

declare(strict_types=1);

namespace Laventure\Contract\Options;

/**
 * HasOptionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Options
 */
interface HasOptionInterface
{
    /**
     * Set options
     *
     * @param array $options
     * @return $this
    */
    public function options(array $options): static;







    /**
     * @return array
    */
    public function getOptions(): array;






    /**
     * @param $key
     * @param $default
     * @return mixed
    */
    public function getOption($key, $default = null): mixed;
}
