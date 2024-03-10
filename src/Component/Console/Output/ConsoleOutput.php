<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Output;

use Laventure\Component\Console\Output\Style\ConsoleStyle;
use Laventure\Component\Console\Output\Style\ConsoleStyleInterface;
use Laventure\Component\Console\Output\Table\ConsoleTable;
use Laventure\Component\Console\Output\Table\ConsoleTableInterface;
use Laventure\Component\Console\Output\Table\DefaultConsoleTable;

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





    /**
     * @inheritDoc
    */
    public function getStyle(): ConsoleStyleInterface
    {
        return new ConsoleStyle();
    }




    /**
     * @inheritDoc
    */
    public function getTable(): ConsoleTableInterface
    {
       return new DefaultConsoleTable();
    }



    /**
     * @inheritDoc
    */
    public function getConsoleTable(): ConsoleTable
    {
       return new ConsoleTable();
    }




    /**
     * @inheritDoc
    */
    public function printList(array $list): void
    {
        $consoleTable = $this->getConsoleTable();

        foreach ($list as $header => $context) {
            $this->writeln("$header:");
            if (is_string($context)) {
                $this->writeln("\x20$context");
            } elseif (is_array($context) && !empty($context)) {
                foreach ($context as $index => $value) {
                    if (is_string($index)) {
                        $consoleTable->addRow([$index, $value]);
                    } else {
                        $this->writeln("\x20$value");
                    }
                }
                if ($consoleTable->getTable()) {
                    $consoleTable->hideBorder();
                    $this->writeln($consoleTable->getTable());
                }
            }
            $this->writeln('');
        }

        $this->print();
        $this->clear();
    }




    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->messages = [];
    }
}
