<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\UnitOfWork;

/**
 * UnitOfWork
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\UnitOfWork
*/
class UnitOfWork implements UnitOfWorkInterface
{
    public const STATE_MANAGED   = 1;
    public const STATE_NEW       = 2;
    public const STATE_DETACHED  = 3;
    public const STATE_REMOVED   = 4;




    /**
     * @inheritdoc
    */
    public function registerState(object $object, $state): mixed
    {

    }





    /**
     * Clear storage
     *
     * @return void
    */
    public function clear(): void
    {

    }
}
