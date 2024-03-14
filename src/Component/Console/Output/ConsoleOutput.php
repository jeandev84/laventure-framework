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
     * @var array
    */
    protected array $space = [];




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
        return $this->write($message.PHP_EOL);
    }






    /**
     * @inheritDoc
    */
    public function tab($message, int $times = 0): static
    {
        # $this->writeln("\x20$message");
        return $this->writeln("\t$message");
    }




    /**
     * @inheritDoc
    */
    public function success($message): void
    {
        $this->writeln($message);
        $this->echo();
    }





    /**
     * @inheritDoc
    */
    public function failure($message): void
    {
        $this->writeln($message);
        $this->echo();
    }





    /**
     * @inheritDoc
    */
    public function invalid($message): void
    {
        $this->writeln($message);
        $this->echo();
    }




    /**
     * @inheritDoc
    */
    public function info($message): void
    {
        $this->writeln($message);
        $this->echo();
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
        $output = join($this->messages);
        $this->clear();
        return $output;
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
    public function printTableList(array $list): void
    {
        foreach ($list as $header => $context) {
            $this->writeln("$header:");
            if (!empty($context)) {
                $consoleTable = $this->getConsoleTable();
                foreach ($context as $index => $value) {
                    if (is_string($index)) {
                        $consoleTable->addRow([$index, $value]);
                    } else {
                        $this->writeln("\x20$value");
                    }
                }
                $consoleTable->hideBorder();
                $this->writeln($consoleTable->getTable());
            } else {
                $this->writeln('');
            }
        }

        $this->print();
    }




    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->messages = [];
    }
}
