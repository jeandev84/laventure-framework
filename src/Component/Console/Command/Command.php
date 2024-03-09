<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Input\Argument\InputArgument;
use Laventure\Component\Console\Input\Collection\InputCollection;
use Laventure\Component\Console\Input\Collection\InputCollectionInterface;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Input\Option\InputOption;
use Laventure\Component\Console\Output\Contract\OutputInterface;
use RuntimeException;

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
    public const INFO     = 3;




    /**
     * @var string
    */
    protected string $defaultName = '';



    /**
     * Command name
     *
     * @var string|null
    */
    protected $name;





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
    protected array $help = ['h', '--help'];






    /**
     * @var InputCollectionInterface
    */
    protected InputCollectionInterface $inputs;






    /**
     * @param $name
    */
    public function __construct($name = null)
    {
        $this->inputs = new InputCollection();
        $this->name   = $name;
        $this->configure();
    }





    /**
     * @inheritDoc
    */
    public function setName($name): static
    {
        $this->name = $name;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        if (!$this->name) {
            return $this->defaultName;
        }

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
     * @inheritDoc
    */
    public function setDescription(array $description): static
    {
        $this->description = $description;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getHelp(): string
    {
        return join('|', $this->help);
    }





    /**
     * @inheritDoc
    */
    public function setHelp(array $help): static
    {
        $this->help = $help;

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function addArgument(
        string $name,
        $description,
        string $default = null,
        array $rules = []
    ): static {
        $this->inputs->addArgument(
            new InputArgument($name, $description, $default, $rules)
        );

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function addOption(
        $name,
        $description,
        $shortcut = null,
        $default = null,
        array $rules = []
    ): static {
        $this->inputs->addOption(
            new InputOption($name, $description, $shortcut, $default, $rules)
        );

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        $input->validate($this->inputs);

        return $this->execute($input, $output);
    }







    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        throw new RuntimeException("You must to return command status inside : ". get_called_class() . "::execute");
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
