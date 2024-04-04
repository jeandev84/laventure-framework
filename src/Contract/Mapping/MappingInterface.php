<?php
declare(strict_types=1);

namespace Laventure\Contract\Mapping;


/**
 * MappingInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Data
*/
interface MappingInterface
{

    /**
     * Map something
     *
     * @return mixed
    */
    public function map(): mixed;
}