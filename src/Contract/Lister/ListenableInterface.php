<?php

declare(strict_types=1);

namespace Laventure\Contract\Lister;

/**
 * ListenableInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Lister
 */
interface ListenableInterface
{
    /**
     * List something
     *
     * @return mixed
    */
    public function list(): mixed;
}
