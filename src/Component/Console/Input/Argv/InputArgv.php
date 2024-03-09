<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Argv;

use Laventure\Component\Console\Input\Contract\InputInterface;

/**
 * InputArgv
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\InputArgv\Common
*/
abstract class InputArgv implements InputInterface
{
    /**
     * @var array
    */
    protected array $tokens = [];


    /**
     * @param array $tokens
    */
    public function __construct(array $tokens)
    {
        $this->tokens = $tokens;
    }



    /**
     * @inheritDoc
    */
    public function getFirstArgument(): string
    {
        return '';
    }




    /**
     * @inheritDoc
    */
    public function getTokens(): array
    {
        return $this->tokens;
    }
}
