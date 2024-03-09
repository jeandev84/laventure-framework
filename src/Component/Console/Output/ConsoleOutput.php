<?php
declare(strict_types=1);

namespace Laventure\Component\Console\Output;

use Laventure\Component\Console\Output\Contract\OutputInterface;

/**
 * ConsoleOutput
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Output
*/
class ConsoleOutput implements OutputInterface
{

    /**
     * @var array
    */
    protected array $messages = [];



    /**
     * @inheritDoc
    */
    public function write($message): static
    {
        $this->messages[] = $message;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function writeln($message): static
    {
        $this->messages[] = "$message". PHP_EOL;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getMessages(): array
    {
        return $this->messages;
    }




    /**
     * @inheritDoc
    */
    public function getMessageAsString(): string
    {
        return join($this->messages);
    }




    /**
     * @inheritDoc
    */
    public function echo(): static
    {
        echo $this->getMessageAsString();

        return $this;
    }
}