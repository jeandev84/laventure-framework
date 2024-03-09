<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Exception\UnableCommandNameException;
use Laventure\Component\Console\Input\Collection\InputCollection;
use Laventure\Component\Console\Input\Collection\InputCollectionInterface;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Output\Contract\OutputInterface;

/**
 * Command
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command
*/
class Command implements CommandInterface
{
    public const SUCCESS  = 0;
    public const FAILURE  = 1;
    public const INVALID  = 2;
    public const INFO     = 4;




    /**
     * Command name
     *
     * @var string
    */
    protected string $name;





    /**
     * Command description
     *
     * @var array
    */
    protected array $description = [];





    /**
     * Help command name
     *
     * @var mixed
    */
    protected array $help = [];





    /**
     * @var InputCollectionInterface
    */
    protected InputCollectionInterface $inputs;






    /**
     * @param $name
    */
    public function __construct($name)
    {
        $this->inputs = new InputCollection();
        $this->name   = $name;
        $this->configure();
    }





    /**
     * @param $name
     * @return $this
    */
    public function name($name): static
    {
        $this->name = $name;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @inheritDoc
    */
    public function getNameAsArray(): array
    {
        $commandName = $this->getName();

        if (!stripos($commandName, ':')) {
            return [];
        }

        return explode(':', $commandName);
    }







    /**
     * @inheritDoc
    */
    public function getDescription(): string
    {
        return join(PHP_EOL, $this->description);
    }






    /**
     * @param array $description
     * @return $this
    */
    public function setDescription(array $description): static
    {
        $this->description = $description;

        return $this;
    }





    /**
     * @return string
    */
    public function getHelp(): string
    {
        return join(PHP_EOL, $this->help);
    }





    /**
     * @param array $help
     * @return static
    */
    public function setHelp(array $help): static
    {
        $this->help = $help;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        return $this->execute($input, $output);
    }







    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        return 0;
    }






    /**
     * @inheritDoc
    */
    public function getInputs(): InputCollectionInterface
    {
        return $this->inputs;
    }





    /** Configure command
     *
     * @return void
    */
    public function configure()
    {
    }
}
