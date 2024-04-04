<?php
declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Fixtures;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Component\Database\ORM\Manager\Fixtures\FixtureManagerInterface;
use Laventure\Foundation\Loader\Fixture\FixtureLoaderInterface;

/**
 * FixtureLoaderCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Fixtures
*/
class FixtureLoaderCommand extends Command
{

    /**
     * @var string
     */
    protected $name = 'fixture:load';




    /**
     * @var array
    */
    protected array $description = [
        "Load all fixtures."
    ];


    /**
     * @param FixtureManagerInterface $fixtureManager
    */
    public function __construct(
        protected FixtureManagerInterface $fixtureManager
    )
    {
        parent::__construct($this->name);
    }




    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
          if ($this->fixtureManager->load()) {
               $output->success("Fixture successfully loaded");
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