<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Resource;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Foundation\Generator\Entity\Exception\EntityGeneratorException;
use Laventure\Foundation\Generator\Resource\Exception\ResourceGeneratorException;
use Laventure\Foundation\Generator\Resource\Factory\ResourceGeneratorFactory;
use Laventure\Foundation\Generator\Resource\ResourceGeneratorInterface;
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
     * @param ResourceGeneratorFactory $resourceGeneratorFactory
    */
    public function __construct(
        protected ResourceGeneratorFactory $resourceGeneratorFactory
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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws ResourceGeneratorException
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        # Check resource classname we want to create that must be entity
        # (e.g, Book|User ...)
        $resourceEntity   = $input->getArgument('name');
        $resourceGenerator = $this->createResourceGenerator();

        if ($input->hasOption(ResourceType::API)) {
            $resourceGenerator = $this->createResourceGenerator(ResourceType::API);
        }

        $resourceGenerator->withResource($resourceEntity);
        $generatorType = $resourceGenerator->getResource()->getType();

        if (!$resourceGenerator->generated()) {
            if ($resourceGenerator->generate()) {
                $output->success("[$generatorType] resource [$resourceEntity] created successfully.");
            }
        } else {
            $output->info("[$generatorType] resource [$resourceEntity] already created!");
            return Command::INFO;
        }

        return Command::SUCCESS;
    }





    /**
     * @param null $type
     * @return ResourceGeneratorInterface
     * @throws ResourceGeneratorException
    */
    protected function createResourceGenerator($type = null): ResourceGeneratorInterface
    {
        return $this->resourceGeneratorFactory->createResourceGenerator($type ?: ResourceType::WEB);
    }




    /**
     * @return string[]
     */
    public function getUsage(): array
    {
        return ["{$this->getName()} [<name>] [options]"];
    }
}
