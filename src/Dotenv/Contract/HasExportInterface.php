<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Contract;

/**
 * HasExportInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Writer
 */
interface HasExportInterface
{
    /**
     * @return mixed
    */
    public function export(): mixed;
}
