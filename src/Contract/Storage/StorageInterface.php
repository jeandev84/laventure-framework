<?php

declare(strict_types=1);

namespace Laventure\Contract\Storage;

use ArrayAccess;
use Laventure\Contract\Parameter\ParameterInterface;

/**
 * StorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Storage
*/
interface StorageInterface extends ParameterInterface
{
    /**
     * session destroy
     *
     * @return mixed
    */
    public function destroy(): mixed;
}
