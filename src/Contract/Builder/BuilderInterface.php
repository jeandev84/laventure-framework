<?php

declare(strict_types=1);

namespace Laventure\Contract\Builder;

/**
 * BuilderInterfaceHas
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Builder
 */
interface BuilderInterface
{
    /**
     * Build something
     *
     * @return mixed
    */
    public function build(): mixed;
}
