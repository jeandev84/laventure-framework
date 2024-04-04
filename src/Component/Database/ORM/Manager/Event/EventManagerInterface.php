<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Event;

/**
 * EventManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager\Event
*/
interface EventManagerInterface
{
    /**
     * @param $event
     *
     * @param callable $callable
     *
     * @return $this
    */
    public function addListener($event, callable $callable): static;





    /**
     * Add listeners
     *
     * @param array $listeners
     *
     * @return $this
    */
    public function addListeners(array $listeners): static;






    /**
     * Determine if the given in listeners
     *
     * @param $event
     *
     * @return bool
    */
    public function hasListener($event): bool;






    /**
     * Returns listeners
     *
     * @return array
    */
    public function getListeners(): array;





    /**
     * @param $event
     * @return array
    */
    public function getListenerFor($event): array;



    /**
     * @return string[]
    */
    public function getPersistEvents(): array;





    /**
     * @return string[]
    */
    public function getRemoveEvents(): array;




    /**
     * @return $this
    */
    public function subscribePersistEvents(): static;




    /**
     * @return $this
    */
    public function subscribeRemoveEvents(): static;







    /**
     * @param object $event
     *
     * @return object
    */
    public function dispatchEvent(object $event): object;
}
