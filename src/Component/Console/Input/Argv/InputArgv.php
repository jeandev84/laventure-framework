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
     * @var mixed
    */
    protected $firstArgument;



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
    protected array $shortcuts = [];






    /**
     * @param array $tokens
    */
    public function __construct(array $tokens)
    {
        $this->tokens       = $tokens;
        $this->compiledFile = array_shift($tokens);
        $this->setFirstArgument(array_shift($tokens));
        $this->parseTokens($tokens);
    }




    /**
     * @param $argument
     * @return $this
    */
    public function setFirstArgument($argument): static
    {
        $this->firstArgument = $argument;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getFirstArgument(): mixed
    {
        return $this->firstArgument;
    }




    /**
     * @inheritDoc
    */
    public function getTokens(): array
    {
        return $this->tokens;
    }





    /**
     * @param $name
     * @param $value
     * @return $this
    */
    public function setArgument($name, $value): static
    {
         $this->arguments[$name] = $value;

         return $this;
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
     * @param $name
     * @return $this
    */
    public function addArgument($name): static
    {
        $this->arguments[] = $name;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getArguments(): array
    {
        return $this->arguments;
    }






    /**
     * @param $name
     * @param $value
     * @return $this
    */
    public function setOption($name, $value): static
    {
        $this->options[$name] = $value;

        return $this;
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
     * @param $name
     * @param $value
     * @return static
     */
    public function shortcutOption($name, $value): static
    {
        $this->shortcuts[$name] = $value;

        return $this;
    }




    /**
     * @param $name
     * @return bool
    */
    public function hasFlag($name): bool
    {
        return $this->getOption($name) === $name;
    }






    /**
     * @inheritDoc
    */
    public function getInteractive(): false|string
    {
       return php_sapi_name();
    }




    /**
     * @inheritDoc
    */
    public function isInteractive(): bool
    {
        $interactive = $this->getInteractive();

        return ($interactive === 'cli' || $interactive === 'phpdbg');
    }




    /**
     * @inheritDoc
    */
    public function getCompiledFile(): string
    {
        return $this->compiledFile;
    }





    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return count($this->tokens);
    }





    /**
     * @inheritDoc
    */
    public function validate(InputCollectionInterface $inputs): mixed
    {
        return false;
    }



     /**
      * @inheritDoc
     */
     public function __toString()
     {
         unset($this->tokens[0]);

         return join(' ', $this->tokens);
     }




     /**
      * @param array $arguments
      * @return bool
     */
     protected function validateArguments(array $arguments): bool
     {

     }
}
