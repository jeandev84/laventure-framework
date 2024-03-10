<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Options;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\OptionCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * EnvironmentCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Options
*/
class EnvironmentCommand extends Command implements OptionCommandInterface
{
    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {

    }
}
