<?php

declare(strict_types=1);

namespace Laventure\Contract\Runner;

/**
 * RunnerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Runner
 */
interface RunnerInterface
{
    /**
     * Run something
     *
     * @return mixed|void
    */
    public function run();
}
