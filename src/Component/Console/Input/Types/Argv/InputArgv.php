<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Types\Argv;

use Laventure\Component\Console\Input\Argument\Exceptions\InputArgumentException;
use Laventure\Component\Console\Input\Argument\Exceptions\RequiredArgumentException;
use Laventure\Component\Console\Input\Argument\InputArgumentInterface;
use Laventure\Component\Console\Input\Collection\InputCollectionInterface;
use Laventure\Component\Console\Input\Exception\InputException;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Input\Option\Exceptions\RequiredOptionException;
use Laventure\Component\Console\Input\Option\InputOptionInterface;

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
            return null;
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
     * @param $name
     * @return bool
    */
    public function hasShortcut($name): bool
    {
        return isset($this->shortcuts[$name]);
    }




    /**
     * @param $name
     * @return string|null
    */
    public function getShortcut($name): ?string
    {
        return $this->shortcuts[$name] ?? null;
    }





    /**
     * @return array
    */
    public function getShortcuts(): array
    {
        return $this->shortcuts;
    }





    /**
     *  Example: $ php console
     *                 database:migrations:migrate
     *                 create_new_users_table
     *                 -table=users
     *                 --refresh=users
     *                 -t
     *                 --test
     *                 --foo
     *
     * @inheritDoc
     */
    public function parseTokens(array $tokens): void
    {
        foreach ($tokens as $token) {
            $this->parseToken($token);
        }
    }




    /**
     * @inheritDoc
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }




    /**
     * @param string $message
     * @param int $code
     * @param array $context
     * @return mixed
     * @throws InputException
     */
    public function abortIf(string $message, int $code = 500, array $context = []): mixed
    {
        throw new InputException($message, $context, $code);
    }






    /**
     * @inheritDoc
     * @throws RequiredArgumentException
     * @throws InputArgumentException|RequiredOptionException
    */
    public function validate(InputCollectionInterface $inputs): bool
    {
        return $this->validateArguments($inputs->getArguments()) && $this->validateOptions($inputs->getOptions());
    }







    /**
     * @param InputArgumentInterface[] $arguments
     * @return bool
     * @throws InputArgumentException
     * @throws RequiredArgumentException
    */
    private function validateArguments(array $arguments): bool
    {
        if (!empty($arguments)) {
            foreach ($arguments as $argument) {
                $this->validateArgument($argument);
            }
        }

        return true;
    }




    /**
     * @param InputArgumentInterface $argument
     * @throws InputArgumentException
     * @throws RequiredArgumentException
    */
    private function validateArgument(InputArgumentInterface $argument): void
    {
        $default = $argument->getDefault();
        $name    = $argument->getName();

        if ($argument->isRequired()) {
            if (!$this->hasArgument($name) && isset($this->arguments[0])) {
                $this->setArgument($name, $this->arguments[0]);
            } else {
                throw new RequiredArgumentException($name);
            }
        } elseif ($argument->isOptional()) {
            $this->setArgument($name, $default ?: $this->getArgument($name));
        }
    }





    /**
     * @param InputOptionInterface[] $options
     * @return bool
     * @throws RequiredOptionException
    */
    private function validateOptions(array $options): bool
    {
        if (!empty($options)) {
            foreach ($options as $option) {
                $this->validateOption($option);
            }
        }

        return true;
    }




    /**
     * @param InputOptionInterface $option
     * @return void
     * @throws RequiredOptionException
    */
    private function validateOption(InputOptionInterface $option): void
    {
        $default  = $option->getDefault();
        $name     = $option->getName();
        $shortcut = $option->getShortCut();

        if($shortcut && $this->hasShortcut($shortcut)) {
            $name = $shortcut;
        }

        if ($option->isRequired() && !$this->hasOption($name)) {
            throw new RequiredOptionException($name);
        } elseif ($option->isOptional()) {
            $this->setOption($name, $default ?: $this->getOption($name));
        }
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
