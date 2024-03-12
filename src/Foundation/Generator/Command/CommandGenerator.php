<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Command;

use Laventure\Component\Console\Command\Exception\CommandException;
use Laventure\Foundation\Generator\ClassGenerator;
use Laventure\Foundation\Generator\FileGenerator;

/**
 * CommandGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Service\Generator\Command
*/
class CommandGenerator extends ClassGenerator
{


    /**
     * @var string|null
    */
    protected ?string $commandName = null;




    /**
     * @var array
    */
    protected array $commandParams = [];




    /**
     * @param $commandName
     * @param array $commandAsArray
     * @return $this
    */
    public function withCommand($commandName, array $commandAsArray): static
    {
        $this->commandName = $commandName;

        foreach ($commandAsArray as $commandParam) {
            $this->commandParams[] = ucfirst($commandParam);
        }

        return $this;
    }





    /**
     * @inheritDoc
     * @throws CommandException
    */
    public function getClassName(): string
    {
         if (empty($this->commandParams)) {
              throw new CommandException("Unavailable command name for generator.". get_called_class());
         }

         return sprintf('%sCommand', join($this->commandParams));
    }




    /**
     * @return string
    */
    public function getCommandsDir(): string
    {
        return trim($this->config['console.commands.dir'], DIRECTORY_SEPARATOR);
    }




    /**
     * @inheritDoc
     * @throws CommandException
    */
    public function getTargetPath(): ?string
    {
        return sprintf('%s/%s.php', $this->getCommandsDir(), $this->getClassName());
    }




    /**
     * @inheritDoc
     * @throws CommandException
    */
    public function getContent(): ?string
    {
        // CommandStub
        return $this->generateStub([
            "DummyNamespace"      => $this->config['console.commands.prefix'],
            "DummyClassName"      => $this->getClassName(),
            "CommandNameProperty" => "name",
            "commandName"         => $this->commandName
        ]);
    }





    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        return __DIR__.'/stub/command.stub';
    }
}