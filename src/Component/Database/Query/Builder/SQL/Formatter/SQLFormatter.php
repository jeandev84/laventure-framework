<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Formatter;

use Laventure\Contract\Formatter\FormatterInterface;
use Stringable;

/**
 * SQlFormatter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Formatter
 */
class SQLFormatter implements FormatterInterface
{
    /**
     * @var string[]
    */
    protected array $formats = [];



    /**
     * @param array $formats
     * @return $this
    */
    public function addFormats(array $formats): static
    {
        foreach ($formats as $format) {
            $this->addFormat($format);
        }

        return $this;
    }





    /**
     * @param Stringable $format
     * @return $this
    */
    public function addFormat(Stringable $format): static
    {
        $this->formats[] = strval($format);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function format(): string
    {
        /* return join(' ', array_filter($this->formats)) . ";"; */
        return join(' ', array_filter($this->formats));
    }





    public function __destruct()
    {
        $this->formats = [];
    }
}
