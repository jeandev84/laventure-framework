<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Class;


use Laventure\Component\Filesystem\File\Generator\FileGeneratorInterface;

/**
 * ClassGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Class
 */
interface ClassGeneratorInterface extends FileGeneratorInterface
{
    /**
     * Returns class name
     *
     * @return string
     */
     public function getClassName(): string;
}