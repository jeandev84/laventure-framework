<?php

declare(strict_types=1);

namespace Laventure\Foundation\Server\Contract;

/**
 * WebServerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Web\Server\Writer
 */
interface WebServerInterface
{
    /**
     * Returns server info
     *
     * @return mixed
    */
    public function getInfo(): mixed;
}
