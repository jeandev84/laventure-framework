<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Stream\DTO;

/**
 * StreamParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Stream\DTO
*/
class StreamParams
{
    /**
     * @param string $filename
     * @param string $mode
     * @param bool $useIncludePath
     * @param $context
    */
    public function __construct(
        public string $filename,
        public string $mode = 'r',
        public bool $useIncludePath = false,
        public $context = null
    ) {
    }


    public static function fromArray(array $config): static
    {
        return new self(
            $config['filename'],
            $config['mode'],
            $config['useIncludePath'],
            $config['context']
        );
    }
}
