<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Argv;

use Laventure\Component\Console\Input\Argument\InputArgumentException;
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
        $name = $name ?: 0;

        if (!$this->hasArgument($name)) {
            throw new InputArgumentException("Invalid argument ($name) parsed.");
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
     * @param array $arguments
    */
    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
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
     * @return string
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
    public function __toString()
    {
        array_shift($this->tokens);

        return join(' ', $this->tokens);
    }






    /**
     * @return array
    */
    public function getShortcuts(): array
    {
        return $this->shortcuts;
    }





    /**
     * @inheritDoc
    */
    public function validate(InputCollectionInterface $inputs): bool
    {
        return $this->validateArguments($inputs->getArguments()) ||
               $this->validateOptions($inputs->getOptions());
    }





    /**
     * @param array $arguments
     * @return bool
    */
    private function validateArguments(array $arguments): bool
    {
        return false;
    }





    /**
     * @param array $options
     * @return bool
    */
    private function validateOptions(array $options): bool
    {
        return false;
    }






    /**
     * @inheritDoc
    */
    public function parseTokens(array $tokens): void
    {
        foreach ($tokens as $token) {
            $this->parseToken($token);
        }

        dump($this, __METHOD__);
    }




    /**
     * @inheritDoc
    */
    public function getTokens(): array
    {
        return $this->tokens;
    }





    /**
     *  $ php console
     *        database:migrations:migrate
     *        create_new_users_table path='/database/migrations/' -table=users --refresh=users -t --r --force
     *
     * @param $token
     * @return void
    */
    abstract protected function parseToken($token): void;
}
