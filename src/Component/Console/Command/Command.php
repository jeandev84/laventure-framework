<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Exception\InvalidCommandStatusException;
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
     * @var string
    */
    protected $name = '';





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
    protected array $help = ['h', 'help'];






    /**
     * @var InputCollectionInterface
    */
    protected InputCollectionInterface $inputs;






    /**
     * @param $name
    */
    public function __construct($name = null)
    {
        if ($name) {
            $this->name = $name;
        }

        $this->inputs = new InputCollection();

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
        return $this->name;
    }




    /**
     * @inheritDoc
    */
    public function getNameSeparator(): string
    {
         return ':';
    }




    /**
     * @inheritDoc
    */
    public function hasNameSeparated(): bool
    {
        return stripos($this->getName(), $this->getNameSeparator()) !== false;
    }




    /**
     * @inheritDoc
    */
    public function getFirstNameSeparated(): string
    {
        return $this->getNameAsArray()[0] ?? '';
    }





    /**
     * @inheritDoc
    */
    public function getNameAsArray(): array
    {
        if (!$this->hasNameSeparated()) {
            return [];
        }

        return explode($this->getNameSeparator(), $this->getName());
    }





    /**
     * @inheritDoc
    */
    public function getDescription(): array
    {
        return $this->description;
    }






    /**
     * @inheritDoc
    */
    public function description(array $description): static
    {
        $this->description = $description;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getDescriptionAsString(): string
    {
        return join('. ', $this->description);
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
    public function help(array $help): static
    {
        $this->help = $help;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getHelpAsString(): string
    {
        return join(', ', $this->help);
    }








    /**
     * @inheritDoc
    */
    public function argument(
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
    public function option(
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
        // call help command


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
    public function getAvailableStatus(): array
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
}
