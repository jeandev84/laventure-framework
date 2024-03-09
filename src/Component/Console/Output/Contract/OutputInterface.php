<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Output\Contract;

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
     * @return array
    */
    public function getMessages(): array;






    /**
     * @return string
    */
    public function getMessagesAsString(): string;






    /**
     * @return void
    */
    public function echo(): void;






    /**
     * @return void
    */
    public function print(): void;
}
