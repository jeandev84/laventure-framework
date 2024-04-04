<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Logger\Writer;

use Stringable;

/**
 * LoggerWriterTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Logger\Writer
 */
trait LoggerWriterTrait
{
    protected $level;
    protected Stringable|string $message;
    protected array $context = [];


    /**
     * @param $level
     * @return $this
    */
    public function level($level): static
    {
        $this->level = $level;

        return $this;
    }


    /**
     * @param Stringable|string $message
     * @return $this
     */
    public function message(Stringable|string $message): static
    {
        $this->message = $message;

        return $this;
    }


    /**
     * @param array $context
     * @return $this
    */
    public function context(array $context): static
    {
        $this->context = $context;

        return $this;
    }




    /**
     * @return mixed
    */
    abstract public function write(): mixed;
}
