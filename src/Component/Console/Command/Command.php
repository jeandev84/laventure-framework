<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command;

use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Exception\InvalidCommandStatusException;
use Laventure\Component\Console\Command\Exception\NotExecutableCommandException;
use Laventure\Component\Console\Input\Argument\InputArgument;
use Laventure\Component\Console\Input\Argument\InputArgumentInterface;
use Laventure\Component\Console\Input\Collection\InputCollection;
use Laventure\Component\Console\Input\Collection\InputCollectionInterface;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Input\Option\InputOption;
use Laventure\Component\Console\Input\Option\InputOptionInterface;
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
     * @var string
    */
    protected $defaultName = '';



    /**
     * Command name
     *
     * @var string
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
    public function addDescription(array $description): static
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
    public function addHelp(array $help): static
    {
        $this->help = $help;

        return $this;
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
        $input->validate($this->inputs);

        $status = $this->execute($input, $output);

        if ($this->hasValidStatus($status)) {
            throw new InvalidCommandStatusException($status,
           get_called_class() . "::execute",
                  $this->availableStatus
            );
        }

        return $status;
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
    protected function configure() {}
}
