<?php

declare(strict_types=1);

namespace Laventure\Contract\Convertor;

/**
 * ConvertorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Convertor
*/
interface ConvertorInterface
{
    /**
     * Convert something
     *
     * @return mixed
    */
    public function convert(): mixed;
}
