<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Collection;

use Laventure\Component\Console\Input\Argument\InputArgumentInterface;
use Laventure\Component\Console\Input\Option\InputOptionInterface;

/**
 * InputCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\InputArgv\Collection
*/
class InputCollection implements InputCollectionInterface
{
    /**
     * @var InputArgumentInterface[]
    */
    protected array $arguments = [];




    /**
     * @var InputOptionInterface[]
    */
    protected array $options = [];






    /**
     * @inheritDoc
    */
    public function getArguments(): array
    {
        return $this->arguments;
    }




    /**
     * @param InputArgumentInterface $argument
     * @return $this
    */
    public function addArgument(InputArgumentInterface $argument): static
    {
        $this->arguments[$argument->getName()] = $argument;

        return $this;
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
    public function getArgument($name): ?InputArgumentInterface
    {
        return $this->arguments[$name] ?? null;
    }





    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }





    /**
     * @param InputOptionInterface $option
     * @return $this
    */
    public function addOption(InputOptionInterface $option): static
    {
        $this->options[$option->getName()] = $option;

        return $this;
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
    public function getOption($name): ?InputOptionInterface
    {
        return $this->options[$name] ?? null;
    }
}
