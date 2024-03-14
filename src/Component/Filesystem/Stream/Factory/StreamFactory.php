<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Stream\Factory;

use Laventure\Component\Filesystem\Stream\Stream;

/**
 * StreamFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Stream\Factory
*/
class StreamFactory
{
    /**
     * @param string $filename
     * @param string $mode
     * @param bool $useIncludePath
     * @param $context
     * @return Stream
    */
    public function create(
        string $filename,
        string $mode = 'r',
        bool $useIncludePath = false,
        $context = null
    ): Stream {
        return new Stream($filename, $mode, $useIncludePath, $context);
    }
}
