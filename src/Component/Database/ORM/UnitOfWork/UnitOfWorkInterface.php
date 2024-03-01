<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\UnitOfWork;

/**
 * UnitOfWorkInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\UnitOfWork
*/
interface UnitOfWorkInterface
{
    /**
     * Register state
     *
     * @param object $object
     * @param $state
     * @return mixed
    */
    public function registerState(object $object, $state): mixed;






    /**
     * Find id
     *
     * @param $id
     * @return mixed
    */
    public function find($id): mixed;







    /**
     * Commit changes
     *
     * @return void
    */
    public function commit(): void;
}
