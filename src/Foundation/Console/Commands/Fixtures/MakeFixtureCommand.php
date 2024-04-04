<?php
declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Fixtures;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Generator\Fixture\FixtureGenerator;

/**
 * MakeFixtureCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Fixtures
*/
class MakeFixtureCommand extends Command
{


    /**
     * @var string
     */
    protected $name = 'make:fixture';




    /**
     * @var array
    */
    protected array $description = [
        "Creates a new fixture."
    ];




    /**
     * @param FixtureGenerator $fixtureGenerator
    */
    public function __construct(
        protected FixtureGenerator $fixtureGenerator
    )
    {
        parent::__construct($this->name);
    }




    /**
     * @inheritDoc
    */
    protected function configure(): void
    {
        $this->addArgument('name', "Choose a fixture name (e.g. MyClassFixture)")
             ->required();
    }



    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
         $entity = $input->getArgument('name');
         $this->fixtureGenerator->withClassName($entity);

         if (!$this->fixtureGenerator->generated()) {
             if ($this->fixtureGenerator->generate()) {
                 $output->success("New fixture file generated.");
                 $output->success("Target path [{$this->fixtureGenerator->getTargetPath()}].");
             }
         } else {
             $fixture = $this->fixtureGenerator->getClassName();
             $output->info("[$fixture] fixture already created for [$entity]!");
             return Command::INFO;
         }

         return Command::SUCCESS;
    }




    /**
     * @return string[]
    */
    public function getUsage(): array
    {
        return ["$this->name [name] [options]"];
    }
}