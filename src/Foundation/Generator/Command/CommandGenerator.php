<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Command;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Console\Command\Resolver\CommandNameResolver;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Class\ClassGenerator;
use Laventure\Foundation\Generator\Command\Exception\CommandGeneratorException;
use Laventure\Foundation\Generator\Command\Exception\GeneratorCommandParamsException;
use Laventure\Foundation\Generator\Command\Exception\UnavailableCommandParamsException;

/**
 * CommandGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Service\Generator\Command
*/
class CommandGenerator extends ClassGenerator implements CommandGeneratorInterface
{
    /**
     * @var array
    */
    protected array $commandParams = [];


    /**
     * @param Application $app
     * @param FilesystemInterface $filesystem
     * @param ConfigInterface $config
     * @param CommandNameResolver $commandNameResolver
    */
    public function __construct(
        Application $app,
        FilesystemInterface $filesystem,
        ConfigInterface $config,
        protected CommandNameResolver $commandNameResolver
    ) {
        parent::__construct($app, $filesystem, $config);
    }


    /**
     * @param $commandName
     * @return $this
    */
    public function withCommand($commandName): static
    {
        $this->commandNameResolver->withName($commandName);
        $commandParams = [$commandName];

        if ($this->commandNameResolver->hasSeparator()) {
            $commandParams = $this->commandNameResolver->loadNameAsArray();
        }

        foreach ($commandParams as $commandParam) {
            $this->commandParams[] = ucfirst($commandParam);
        }

        return $this;
    }





    /**
     * @inheritDoc
     * @throws CommandGeneratorException
    */
    public function getClassName(): string
    {
        if (empty($this->commandParams)) {
            throw new UnavailableCommandParamsException(get_called_class());
        }

        return sprintf('%sCommand', join($this->commandParams));
    }




    /**
     * @inheritDoc
    */
    public function getBaseDir(): string
    {
        return $this->trimPath($this->config['console.commands.dir']);
    }





    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return $this->config['console.commands.prefix'];
    }






    /**
     * @inheritDoc
     * @throws CommandGeneratorException
     */
    public function getContent(): string
    {
        // CommandStub
        return $this->generateStub([
            "DummyNamespace"      => $this->getNamespace(),
            "DummyClassName"      => $this->getClassName(),
            "CommandNameProperty" => "name",
            "commandName"         => $this->getCommandName()
        ]);
    }





    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        return __DIR__.'/stub/command.stub';
    }





    /**
     * @inheritDoc
    */
    public function getCommandName(): string
    {
        return $this->commandNameResolver->getName();
    }



    /**
     * @inheritDoc
    */
    public function getCommandNameAsArray(): array
    {
        return $this->commandParams;
    }
}
