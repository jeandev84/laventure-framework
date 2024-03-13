<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Resource;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Generator\Entity\Exception\EntityGeneratorException;
use Laventure\Foundation\Generator\Resource\Types\Api\ApiResourceGenerator;
use Laventure\Foundation\Generator\Resource\Types\Web\WebResourceGenerator;

/**
 * MakeResourceCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console\Commands\Resource
*/
class MakeResourceCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'make:resource';




    /**
     * @var array
     */
    protected array $description = [
        "Creates a new resource (e.g api or web)."
    ];





    /**
     * @param ApiResourceGenerator $apiResourceGenerator
     * @param WebResourceGenerator $webResourceGenerator
    */
    public function __construct(
        protected ApiResourceGenerator $apiResourceGenerator,
        protected WebResourceGenerator $webResourceGenerator
    ) {
        parent::__construct($this->name);
    }


    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('name', "Choose a resource name (e.g. Books/Book or User)")
            ->required();
        $this->addOption('api', "This option mean that we want to create an [API] resource.)")
             ->optional();
    }





    /**
     * @inheritDoc
     * @throws EntityGeneratorException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        # Check resource classname we want to create that must be entity
        # (e.g, Book|User ...)
        $resource = $input->getArgument('name');

        # generate resource
        # TODO refactoring will do it more clear
        if ($input->hasOption('api')) {
            if (!$this->apiResourceGenerator->generated()) {
                if($this->apiResourceGenerator->withResource($resource)->generate()) {
                    $output->success("API Resource [$resource] created successfully.");
                }
            } else {
                $output->info("API Resource [$resource] already created!");
                return Command::INFO;
            }
        } else {
            if (!$this->webResourceGenerator->generated()) {
                if($this->webResourceGenerator->withResource($resource)->generate()) {
                    $output->success("Web Resource [$resource] created successfully.");
                }
            } else {
                $output->info("Web Resource [$resource] already created!");
                return Command::INFO;
            }
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
