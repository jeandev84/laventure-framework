<?php
declare(strict_types=1);

namespace Laventure\Component\Console\Command\Options;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\OptionCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * NoDebugCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Options
 */
class NoDebugCommand extends Command implements OptionCommandInterface
{

    /**
     * @inheritDoc
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        // TODO: Implement execute() method.
    }

    /**
     * @inheritDoc
     */
    public function getShortcutOption(): string
    {
        // TODO: Implement getShortcutName() method.
    }

    /**
     * @inheritDoc
     */
    public function getLongOption(): string
    {
        // TODO: Implement getLongOptions() method.
    }
}