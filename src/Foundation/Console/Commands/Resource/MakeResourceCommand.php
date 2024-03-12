<?php
declare(strict_types=1);

namespace Laventure\Foundation\Console\Commands\Resource;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Generator\Controller\ControllerGenerator;
use Laventure\Foundation\Generator\Resource\Api\ApiResourceGenerator;
use Laventure\Foundation\Generator\Resource\Web\WebResourceGenerator;

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
    )
    {
        parent::__construct($this->name);
    }


    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('name', "Choose a controller name (e.g. Books/Book or User)")
            ->required();
        $this->addOption('api', "This option mean that we want to create an [API] resource)")
             ->optional();
    }





    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        # Check controller name we want to create
        $entity = $input->getArgument('name');

        dd($entity);

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