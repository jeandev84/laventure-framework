<?php

declare(strict_types=1);

namespace Laventure\Contract\Storage;

/**
 * SaveInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Drivers\Storage
 */
interface SaveInterface
{
    /**
     * Save something
     *
     * @return mixed
    */
    public function save(): mixed;
}
