<?php
declare(strict_types=1);

namespace Laventure\Component\Console\Command\Defaults\Options;

use Laventure\Component\Console\Command\Command;
use Laventure\Component\Console\Command\Contract\OptionCommandInterface;
use Laventure\Component\Console\Input\InputInterface;
use Laventure\Component\Console\Output\OutputInterface;

/**
 * QuietCommand
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Options
*/
class QuietCommand extends Command implements OptionCommandInterface
{

    /**
     * @param $name
    */
    public function __construct($name = null)
    {
        parent::__construct($name);
    }



    /**
     * @inheritDoc
    */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
          return Command::SUCCESS;
    }



    /**
     * @inheritDoc
    */
    public function getShortcutOption(): string
    {
        return '-q';
    }



    /**
     * @inheritDoc
    */
    public function getLongOption(): string
    {
         return '--quiet';
    }
}
