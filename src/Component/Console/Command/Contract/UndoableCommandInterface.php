<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;

use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * UndoableCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface UndoableCommandInterface
{
    /**
     * Reverse or Rollback command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
    */
    public function undo(InputInterface $input, OutputInterface $output): mixed;
}
