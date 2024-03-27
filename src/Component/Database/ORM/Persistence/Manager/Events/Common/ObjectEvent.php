<?php

namespace Laventure\Component\Database\ORM\Persistence\Manager\Events\Common;

/**
 * @ObjectEvent
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\DataMapper\Manager\Events\Common
*/
abstract class ObjectEvent
{
    /**
     * @param object $object
    */
    public function __construct(protected object $object)
    {

    }



    /**
     * @return object
    */
    public function getSubject(): object
    {
        return $this->object;
    }
}
