<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Argv;

use Laventure\Component\Console\Input\Collection\InputCollectionInterface;

/**
 * ConsoleInputArgv
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Input\Argv
*/
class ConsoleInputArgv extends InputArgv
{

    /**
     * @param array $tokens
    */
    public function __construct(array $tokens = [])
    {
        parent::__construct($tokens ?: $_SERVER['argv']);
    }



    /**
     * @inheritDoc
    */
    public function parseTokens(array $tokens): void
    {

    }



    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $_SERVER['argc'] ?? 0;
    }
}
