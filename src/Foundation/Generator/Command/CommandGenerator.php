<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Command;

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
     * @var string
    */
    protected string $commandName = '';




    /**
     * @var array
    */
    protected array $commandNameParams = [];




    /**
     * @param $commandName
     * @param array $commandNameAsArray
     * @return $this
    */
    public function withCommand($commandName, array $commandNameAsArray): static
    {
        $this->commandName = $commandName;

        foreach ($commandNameAsArray as $commandParam) {
            $this->commandNameParams[] = ucfirst($commandParam);
        }

        return $this;
    }





    /**
     * @inheritDoc
     * @throws CommandGeneratorException
    */
    public function getClassName(): string
    {
        if (empty($this->commandNameParams)) {
            throw new UnavailableCommandParamsException(get_called_class());
        }

        return sprintf('%sCommand', join($this->commandNameParams));
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
    public function getBaseNamespace(): string
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
        return $this->commandName;
    }



    /**
     * @inheritDoc
    */
    public function getCommandNameAsArray(): array
    {
        return $this->commandNameParams;
    }
}
