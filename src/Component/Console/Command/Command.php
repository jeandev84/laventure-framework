<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Exception\InvalidCommandStatusException;
use Laventure\Component\Console\Command\Resolver\CommandNameResolver;
use Laventure\Component\Console\Input\Argument\InputArgument;
use Laventure\Component\Console\Input\Argument\InputArgumentInterface;
use Laventure\Component\Console\Input\Collection\InputCollection;
use Laventure\Component\Console\Input\Collection\InputCollectionInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Input\Option\InputOption;
use Laventure\Component\Console\Input\Option\InputOptionInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * Command
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command
*/
abstract class Command implements CommandInterface
{
    public const SUCCESS  = 0;
    public const FAILURE  = 1;
    public const INVALID  = 2;
    public const INFO     = 3;



    /**
     * @var InputCollectionInterface
    */
    protected InputCollectionInterface $inputs;




    /**
     * @var array|int[]
    */
    private array $availableStatus = [
        self::SUCCESS,
        self::INFO,
        self::INVALID,
        self::INFO
    ];




    /**
     * Command name
     *
     * @var string|null
    */
    protected $name = null;





    /**
     * Command description
     *
     * @var array
    */
    protected array $description = [];






    /**
     * @var array
    */
    protected array $usage = ['command [options] [arguments]'];




    /**
     * Help description
     *
     * @var mixed
    */
    protected array $help = [];






    /**
     * @param $name
    */
    public function __construct($name = null)
    {
        $this->inputs = new InputCollection();

        if ($name) {
            $this->name = $name;
        }

        $this->configure();
    }





    /**
     * @inheritDoc
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
        return strval($this->name);
    }




    /**
     * @return CommandNameResolver
    */
    public function getCommandNameResolver(): CommandNameResolver
    {
        return new CommandNameResolver($this->getName());
    }






    /**
     * @inheritDoc
    */
    public function hasNameSeparator(): bool
    {
        return $this->separatedName($this->getName());
    }




    /**
     * @inheritDoc
    */
    public function getFirstName(): string
    {
        return $this->getNameAsArray()[0] ?? '';
    }





    /**
     * @inheritDoc
    */
    public function getNameAsArray(): array
    {
        return $this->getCommandNameResolver()->loadNameAsArray();
    }





    /**
     * @inheritDoc
    */
    public function getDescriptions(): array
    {
        return $this->description;
    }






    /**
     * @inheritDoc
    */
    public function description(string $description): static
    {
        $this->description[] = $description;

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function getHelp(): array
    {
        return $this->help;
    }







    /**
     * @inheritDoc
    */
    public function addHelp(array $help): static
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
    ): InputArgumentInterface {
        return $this->inputs->addArgument(
            new InputArgument($name, $description, $default, $rules)
        );
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
    ): InputOptionInterface {
        return $this->inputs->addOption(
            new InputOption($name, $description, $shortcut, $default, $rules)
        );
    }






    /**
     * @param int $status
     * @return bool
    */
    public function hasValidStatus(int $status): bool
    {
        return in_array($status, $this->availableStatus);
    }







    /**
     * @inheritDoc
    */
    public function run(InputInterface $input, OutputInterface $output): int
    {
        // validate inputs
        $input->validate($this->inputs);

        // execute command
        $status = $this->execute($input, $output);

        // make sure has valid status
        if (!$this->hasValidStatus($status)) {
            throw new InvalidCommandStatusException($this, $status, "execute");
        }

        // return status
        return $status;
    }






    /**
     * @inheritDoc
    */
    public function getInputs(): InputCollectionInterface
    {
        return $this->inputs;
    }




    /**
     * @inheritDoc
    */
    public function getArguments(): array
    {
        return $this->inputs->getArguments();
    }




    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->inputs->getOptions();
    }






    /**
     * @inheritDoc
    */
    public function getAvailableStatuses(): array
    {
        return $this->availableStatus;
    }





    /** Configure command
     *
     * @return void
    */
    protected function configure()
    {
    }




    /**
     * @inheritDoc
    */
    public function getUsage(): array
    {
        return $this->usage;
    }






    /**
     * @inheritDoc
    */
    public function getDefaultList(): array
    {
        return [
            'Usage'        => $this->getUsage(),
            'Options'      => $this->getOptionList(),
        ];
    }




    /**
     * @inheritDoc
    */
    public function getHelpList(): array
    {
        return [
           'Description' => $this->getDescriptions(),
           'Usage'       => $this->getUsage(),
           'Arguments'   => $this->getArgumentList(),
           'Options'     => $this->getOptionList(),
           'Help'        => $this->getHelp()
        ];
    }




    /**
     * @inheritDoc
    */
    public function toArray(): array
    {
        return [
            'Usage'        => $this->getUsage(),
            'Description'  => $this->getDescriptions(),
            'Help'         => $this->getHelp(),
            'Arguments'    => $this->getArguments(),
            'Options'      => $this->getOptions(),
        ];
    }





    /**
     * @return array
    */
    protected function getArgumentList(): array
    {
        $arguments = [];

        foreach ($this->getArguments() as $argument) {
            $arguments[$argument->getName()] = $argument->getDescription();
        }

        return $arguments;
    }




    /**
     * @return array
    */
    protected function getOptionList(): array
    {
        $options = [];

        foreach ($this->getOptions() as $option) {
            $options[$option->getOptionsAsString()] = $option->getDescription();
        }

        return $options;
    }




    /**
     * @inheritDoc
    */
    public function getDescription(): string
    {
        return join('. ', $this->description);
    }





    /**
     * @inheritDoc
    */
    public function getHelpAsString(): string
    {
        return join(PHP_EOL, $this->help);
    }




    /**
     * @param $name
     * @return bool
    */
    protected function separatedName($name): bool
    {
        return $this->getCommandNameResolver()->separated($name);
    }
}
