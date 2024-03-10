<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Output;

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
    public function output(): string
    {
        return join($this->messages);
    }




    /**
     * @inheritDoc
    */
    public function echo(): void
    {
        echo $this->output();
    }



    /**
     * @inheritDoc
    */
    public function tab($message, int $times = 0): static
    {
        return $this->writeln("\t$message");
    }


    /**
     * @inheritDoc
    */
    public function print(): void
    {
        print($this->output());
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->output();
    }
}
