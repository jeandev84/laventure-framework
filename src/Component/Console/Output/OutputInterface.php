<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Output;

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
}
