<?php

declare(strict_types=1);

namespace Laventure\Contract\Generator;

/**
 * GeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Generator
 */
interface GeneratorInterface
{
    /**
     * Generate something
     *
     * @return mixed
    */
    public function generate(): mixed;
}
