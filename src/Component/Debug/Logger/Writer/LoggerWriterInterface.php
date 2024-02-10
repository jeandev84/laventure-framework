<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Logger\Writer;

use Laventure\Contract\Writer\WriterInterface;
use Stringable;

/**
 * LoggerWriterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Logger\Writer
 */
interface LoggerWriterInterface extends WriterInterface
{
    /**
     * @param $level
     * @return mixed
    */
    public function level($level): mixed;


    /**
     * @param Stringable|string $message
     * @return mixed
    */
    public function message(Stringable|string $message): mixed;


    /**
     * @param array $context
     * @return mixed
    */
    public function context(array $context): mixed;




    /**
     * @return mixed
    */
    public function write(): mixed;
}
