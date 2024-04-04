<?php

declare(strict_types=1);

namespace Laventure\Contract\Autoloader;

/**
 * AutoloaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Autoloader
*/
interface AutoloaderInterface
{
    /**
     * @return mixed
    */
    public function autoload(): mixed;
}
