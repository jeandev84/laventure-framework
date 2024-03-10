<?php

declare(strict_types=1);

namespace Laventure\Foundation\Console;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\CommandInterface;
use Laventure\Component\Console\Command\Exception\EmptyCommandNameException;
use Laventure\Component\Console\Console;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Kernel\ConsoleKernelInterface;
use Laventure\Component\Console\Kernel\TerminateInterface;
use Laventure\Component\Console\Output\OutputInterface;
use Laventure\Foundation\Application;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use Throwable;

/**
 * ConsoleKernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Console
*/
class ConsoleKernel implements ConsoleKernelInterface, TerminateInterface
{
    /**
     * @var Application
    */
    protected Application $app;



    /**
     * @var Console
    */
    protected Console $console;




    /**
     * @var array
    */
    private array $defaultCommands = [

    ];



    /**
     * @var array
    */
    protected array $commands = [];


    /**
     * @param Application $app
     * @param Console $console
     */
    public function __construct(Application $app, Console $console)
    {
        $this->app = $app;
        $this->console = $console;
    }



    /**
     * @inheritDoc
    */
    public function handle(InputInterface $input, OutputInterface $output): int
    {
        try {
            return $this->console->addCommands($this->loadCommands())->run($input, $output);
        } catch (Throwable $e) {
            $output->failure($e->getMessage());
            return Command::FAILURE;
        }
    }



    /**
     * @inheritDoc
    */
    public function terminate(InputInterface $input, $status)
    {
        exit($status);
    }




    /**
     * @return CommandInterface[]
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws ReflectionException
    */
    private function loadCommands(): array
    {
        $availableCommands = array_map(function ($commandClass) {
            return $this->app->get($commandClass);
        }, $this->getAvailableCommands());

        return array_filter($availableCommands, function ($command) {
            return $command instanceof CommandInterface;
        });
    }




    /**
     * @return string[]
    */
    private function getAvailableCommands(): array
    {
        return array_merge($this->defaultCommands, $this->commands);
    }
}
