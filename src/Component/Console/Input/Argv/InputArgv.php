<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Argv;

use Laventure\Component\Console\Input\Collection\InputCollectionInterface;
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
     * @var string
    */
    protected string $compiledFile;



    /**
     * @var string
    */
    protected string $firstArgument;



    /**
     * @var array
    */
    protected array $tokens = [];



    /**
     * @var array
    */
    protected array $arguments = [];



    /**
     * @var array
    */
    protected array $options = [];




    /**
     * @var array
    */
    protected $shortcuts = [];





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





    /**
     * @inheritDoc
    */
    public function getArgument($name = null): mixed
    {
        if (!$name) {
            return $this->arguments[0] ?? $name;
        }

        return $this->arguments[$name];
    }





    /**
     * @inheritDoc
    */
    public function hasArgument($name): bool
    {
       return isset($this->arguments[$name]);
    }




    /**
     * @inheritDoc
    */
    public function getArguments(): array
    {
        return $this->arguments;
    }





    /**
     * @inheritDoc
    */
    public function getOption($name): mixed
    {
        return $this->options[$name] ?? null;
    }





    /**
     * @inheritDoc
    */
    public function hasOption($name): bool
    {
        return isset($this->options[$name]);
    }




    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }





    /**
     * @inheritDoc
    */
    public function getInteractive(): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function isInteractive(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function getCompiledFile(): string
    {
        return $this->compiledFile;
    }





    /**
     * @return int
    */
    abstract public function count(): int;





    /**
     * @inheritDoc
    */
    public function validate(InputCollectionInterface $inputs): mixed
    {

    }
}
