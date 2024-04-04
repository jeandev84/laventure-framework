<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Writer;

use Laventure\Contract\Writer\WriterInterface;

/**
 * CsvFileWriter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Writer
 */
class CsvFileWriter implements WriterInterface
{
    /**
     * @inheritDoc
     */
    public function write(): mixed
    {
        return 'writing ...';
    }
}
