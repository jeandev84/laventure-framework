<?php
declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Controller;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Foundation\Generator\Controller\Api\ApiResourceControllerGenerator;
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
     * @param ApiResourceControllerGenerator $apiResourceControllerGenerator
    */
    public function __construct(
        protected ControllerGenerator $controllerGenerator,
        protected ApiResourceControllerGenerator $apiResourceControllerGenerator
    )
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
        $this->addOption('api', "This option mean that we want to create an [API] resource controller.")
            ->optional();
        $this->addOption('resource', "This option mean that we want to create an [WEB] resource controller.")
             ->shortcut('r')
             ->optional();
    }





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        # Check controller name we want to create
        $controllerName = $input->getArgument('name');

        # Check api option
        if ($input->hasOption('api')) {
            $this->apiResourceControllerGenerator->withApiController($controllerName);
        } elseif ($input->hasOption('resource')) {

        } else {
            # Set controller name an action we want to generate
            $this->controllerGenerator->withController($controllerName, ['index']);
        }



        dd($this->controllerGenerator);


        # Generate controller
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
        return ["{$this->getName()} [<name>] [options]"];
    }
}