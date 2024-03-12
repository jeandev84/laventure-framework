<?php
declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Controller;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Generator\Controller\ControllerGenerator;

/**
 * MakeControllerCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Controller
*/
class MakeControllerCommand extends Command
{

    /**
     * @var string
     */
    protected $name = 'make:controller';




    /**
     * @var array
    */
    protected array $description = [
        "Creates new controller, with action has optional."
    ];




    /**
     * @param ControllerGenerator $controllerGenerator
    */
    public function __construct(protected ControllerGenerator $controllerGenerator)
    {
        parent::__construct($this->name);
    }


    /**
     * @return void
    */
    protected function configure(): void
    {
        $this->addArgument('name', "Choose a controller name (e.g. FooController)")
             ->required();
    }





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $controllerName = $input->getArgument('name');
        $this->controllerGenerator->withController($controllerName);

        if (!$this->controllerGenerator->generated()) {
            $this->controllerGenerator->generate();
            $output->success("Controller [$controllerName] successfully generated.");
        } else {
            $output->info("Controller [$controllerName] already generated.");
        }

        return Command::SUCCESS;
    }





    /**
     * @return string[]
    */
    public function getUsage(): array
    {
        return ["{$this->getName()} [<name>]"];
    }
}