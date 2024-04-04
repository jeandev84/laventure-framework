<?php

namespace Laventure\Component\Database\ORM\Manager\Event;

/**
 * @Event
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Data\Manager\Event
*/
class Event
{
    public const postLoad          = 'postLoad';
    public const prePersist        = 'prePersist';
    public const postPersist       = 'postPersist';
    public const preUpdate         = 'preUpdate';
    public const postUpdate        = 'postUpdate';
    public const preRemove         = 'preRemove';
    public const postRemove        = 'postRemove';
    public const preFlush          = 'preFlush';
    public const onFlush           = 'onFlush';
    public const postFlush         = 'postFlush';
    public const onClear           = 'onClear';
}
