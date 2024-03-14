<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Loader;

use Laventure\Component\Filesystem\File\Loader\Contract\YamlFileLoaderInterface;
use Laventure\Component\Filesystem\File\Traits\HasFileTrait;

/**
 * YamlLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Loader
 */
class YamlLoader extends FileLoader implements YamlFileLoaderInterface
{
    use HasFileTrait;

    /**
     * @inheritDoc
    */
    public function match(): bool
    {
        //TODO if extension in ['yaml, 'yml']
        return false;
    }
}
