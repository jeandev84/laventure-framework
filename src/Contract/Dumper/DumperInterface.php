<?php

declare(strict_types=1);

namespace Laventure\Contract\Dumper;

/**
 * DumperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Dumper
 */
interface DumperInterface
{
    /**
     * @return mixed
    */
    public function dump(): mixed;
}
