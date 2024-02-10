<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Exception\Handler\Manager;

use Laventure\Contract\Runner\RunnerInterface;

/**
 * HandlerManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Exception\Handler\Manager
 */
interface HandlerManagerInterface extends RunnerInterface
{
    /**
     * Returns handlers stack
     *
     * @return array
    */
    public function getHandlers(): array;
}
