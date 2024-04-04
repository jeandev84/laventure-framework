<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Common\Collection\Contract;

use ArrayAccess;
use Countable;
use Iterator;
use Serializable;

/**
 * ObjectCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Common\Collection\Contract
*/
interface CollectionInterface extends Countable, Iterator, Serializable, ArrayAccess
{
    /**
     * @param object $object
     * @return $this
    */
    public function add(object $object): static;





    /**
     * @param object $object
     *
     * @return static
    */
    public function remove(object $object): static;
}
