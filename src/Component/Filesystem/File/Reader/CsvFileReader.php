<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Reader;

use Laventure\Contract\Reader\ReaderInterface;

/**
 * CsvFileReader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Reader
 */
class CsvFileReader implements ReaderInterface
{
    /**
     * @inheritDoc
     */
    public function read(): mixed
    {
        return 'reading ...';
    }
}
