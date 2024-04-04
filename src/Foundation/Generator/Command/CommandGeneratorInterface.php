<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Command;

use Laventure\Foundation\Generator\Class\ClassGeneratorInterface;

/**
 * CommandGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Command
 */
interface CommandGeneratorInterface extends ClassGeneratorInterface
{
    /**
     * Returns command name
     *
     * @return string
    */
    public function getCommandName(): string;



    /**
     * Convert command name as array
     *
     * @return array
    */
    public function getCommandNameAsArray(): array;
}
