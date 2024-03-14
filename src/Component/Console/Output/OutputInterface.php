<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Output;

use Laventure\Component\Console\Output\Style\ConsoleStyleInterface;
use Laventure\Component\Console\Output\Table\ConsoleTable;
use Laventure\Component\Console\Output\Table\ConsoleTableInterface;
use Stringable;

/**
 * OutputInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Output\Contract
*/
interface OutputInterface extends Stringable
{
    /**
     * @param $message
     * @return $this
    */
    public function write($message): static;




    /**
     * @param $message
     * @return $this
    */
    public function writeln($message): static;





    /**
     * @param $message
     * @return void
    */
    public function success($message): void;





    /**
     * @param $message
     * @return void
    */
    public function failure($message): void;





    /**
     * @param $message
     * @return void
    */
    public function invalid($message): void;





    /**
     * @param $message
     * @return void
    */
    public function info($message): void;






    /**
     * @param $message
     * @param int $times
     * @return $this
    */
    public function tab($message, int $times = 0): static;







    /**
     * Returns all messages
     *
     * @return array
    */
    public function getMessages(): array;






    /**
     * Returns all message as string
     *
     * @return string
    */
    public function output(): string;






    /**
     * @return void
    */
    public function echo(): void;






    /**
     * @return void
    */
    public function print(): void;





    /**
     * @param array $list
     * @return void
    */
    public function printTableList(array $list): void;






    /**
     * @return ConsoleStyleInterface
    */
    public function getStyle(): ConsoleStyleInterface;






    /**
     * @return ConsoleTableInterface
    */
    public function getTable(): ConsoleTableInterface;







    /**
     * @return ConsoleTable
    */
    public function getConsoleTable(): ConsoleTable;







    /**
     * @return void
    */
    public function clear(): void;
}
