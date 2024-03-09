<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;

use Laventure\Component\Console\Input\Argument\InputArgumentInterface;
use Laventure\Component\Console\Input\Collection\InputCollectionInterface;
use Laventure\Component\Console\Input\Contract\InputInterface;
use Laventure\Component\Console\Input\Option\InputOptionInterface;
use Laventure\Component\Console\Output\Contract\OutputInterface;

/**
 * CommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface CommandInterface extends ExecutableCommandInterface
{
    /**
     * Return name of command
     *
     * @return string
    */
    public function getName(): string;





    /**
     * Set command name
     *
     * @param $name
     * @return $this
    */
    public function setName($name): static;






    /**
     * Read name as array
     *
     * @return array
    */
    public function getNameAsArray(): array;






    /**
     * @param array $description
     * @return $this
    */
    public function addDescription(array $description): static;






    /**
     * Returns description of command
     *
     * @return string
    */
    public function getDescription(): string;







    /**
     * Returns help command
     *
     * @return string
    */
    public function getHelp(): string;







    /**
     * Set help commands
     *
     * @param array $help
     * @return static
    */
    public function addHelp(array $help): static;


    /**
     * Add new input argument
     *
     * @param string $name
     * @param $description
     * @param string|null $default
     * @param array $rules
     * @return InputArgumentInterface
    */
    public function addArgument(
        string $name,
        $description,
        string $default = null,
        array $rules = []
    ): InputArgumentInterface;




    /**
     * Add new input option
     *
     * @param $name
     * @param $description
     * @param null $shortcut
     * @param null $default
     * @param array $rules
     * @return InputOptionInterface
    */
    public function addOption(
        $name,
        $description,
        $shortcut = null,
        $default = null,
        array $rules = []
    ): InputOptionInterface;








    /**
     * Returns input configuration
     *
     * @return InputCollectionInterface
    */
    public function getInputs(): InputCollectionInterface;







    /**
     * Run command and execute, terminate execution
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
    */
    public function run(InputInterface $input, OutputInterface $output): int;
}
