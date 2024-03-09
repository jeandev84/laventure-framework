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
        $this->messages[] = sprintf('%s%s', $message, PHP_EOL);

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
    public function getMessagesAsString(): string
    {
        return join($this->messages).PHP_EOL;
    }




    /**
     * @inheritDoc
    */
    public function echo(): void
    {
        echo $this->getMessagesAsString();
    }



    /**
     * @inheritDoc
    */
    public function print(): void
    {
        print($this->getMessagesAsString());
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getMessagesAsString();
    }
}
