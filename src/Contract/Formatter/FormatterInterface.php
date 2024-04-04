<?php

declare(strict_types=1);

namespace Laventure\Contract\Formatter;

/**
 * FormatterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Formatter
 */
interface FormatterInterface
{
    /**
     * Format something
     *
     * @return mixed
    */
    public function format(): mixed;
}
