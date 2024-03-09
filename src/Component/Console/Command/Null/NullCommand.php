<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Null;

use Laventure\Component\Console\Command\Command;

/**
 * NullCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Null
*/
class NullCommand extends Command
{
    /**
     * @return string
    */
    public function getName(): string
    {
        return 'command:null';
    }
}
