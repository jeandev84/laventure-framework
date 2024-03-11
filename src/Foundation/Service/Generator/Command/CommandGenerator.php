<?php
declare(strict_types=1);

namespace Laventure\Foundation\Service\Generator\Command;

use Laventure\Component\Console\Command\Exception\CommandException;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Foundation\Service\Generator\FileGenerator;

/**
 * CommandGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Service\Generator\Command
*/
class CommandGenerator extends FileGenerator
{

    /**
     * @var array
    */
    protected array $commandParams = [];




    /**
     * @param array $commandParams
     * @return $this
    */
    public function withCommandParams(array $commandParams): static
    {
        foreach ($commandParams as $commandParam) {
            $this->commandParams[] = ucfirst($commandParam);
        }

        return $this;
    }





    /**
     * @return string
     * @throws CommandException
    */
    public function getClassName(): string
    {
         if (empty($this->commandParams)) {
              throw new CommandException(
          "Unavailable command name for generator.". get_called_class()
              );
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
    */
    public function getTargetPath(): ?string
    {
        return sprintf('%s/%s.php', $this->getCommandsDir(), $this->getClassName());
    }





    /**
     * @inheritDoc
    */
    public function getContent(): ?string
    {
         #dd($this->getClassName(), $this->getTargetPath());
    }
}