<?php

declare(strict_types=1);

namespace Laventure\Foundation\Loader\Controller;

use Laventure\Component\Filesystem\File\Collection\FileCollection;
use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoader;

/**
 * Laventure\Foundation\Loader\Controller
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Controller
*/
class ControllerLoader extends FilesDirectoryLoader
{
    /**
     * @inheritDoc
    */
    public function getPrefix(): string
    {
        return $this->config['routes.controllers.prefix'];
    }






    /**
     * @inheritDoc
    */
    public function getDirectory(): string
    {
        return $this->config['routes.controllers.dir'];
    }
}
