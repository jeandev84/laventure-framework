<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager\Event;


use Laventure\Component\Database\ORM\Persistence\Manager\Events\Common\ObjectEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PostPersistEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PostRemoveEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PostUpdateEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PrePersistEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PreRemoveEvent;
use Laventure\Component\Database\ORM\Persistence\Manager\Events\PreUpdateEvent;
use Laventure\Component\Database\ORM\Persistence\Mapping\Service\ReflectionServiceInterface;

/**
 * EventManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager\Event
*/
class EventManager implements EventManagerInterface
{

    /**
     * @var array
    */
    protected array $listeners = [];



    /**
     * @param ReflectionServiceInterface $reflectionService
    */
    public function __construct(
        protected ReflectionServiceInterface $reflectionService
    )
    {
    }



    /**
     * @inheritDoc
    */
    public function addListener($event, callable $callable): static
    {
        $this->listeners[$event][] = $callable;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addListeners(array $listeners): static
    {
        foreach ($listeners as $event => $listener) {
            $this->addListener($event, $listener);
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function hasListener($event): bool
    {
        return isset($this->listeners[$event]);
    }




    /**
     * @inheritDoc
    */
    public function getListeners(): array
    {
        return $this->listeners;
    }





    /**
     * @inheritDoc
    */
    public function getListenerFor($event): array
    {
        return $this->listeners[$event] ?? [];
    }




    /**
     * @inheritDoc
    */
    public function subscribePersistEvents(): static
    {
        foreach ($this->getPersistEvents() as $event => $callback) {
            if (!$this->hasListener($event)) {
                $this->addListener($event, $callback);
            }
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function subscribeRemoveEvents(): static
    {
        foreach ($this->getRemoveEvents() as $event => $callback) {
            if (! $this->hasListener($event)) {
                $this->addListener($event, $callback);
            }
        }

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function dispatchEvent(object $event): object
    {
        $eventName = get_class($event);

        if ($this->hasListener($eventName)) {
            foreach ($this->listeners[$eventName] as $listener) {
                call_user_func($listener, $event);
            }
        }

        return $event;
    }






    /**
     * @inheritDoc
     */
    public function getPersistEvents(): array
    {
        return [
            PrePersistEvent::class   => [$this, Event::prePersist],
            PostPersistEvent::class  => [$this, Event::postPersist],
            PreUpdateEvent::class    => [$this, Event::preUpdate],
            PostUpdateEvent::class   => [$this, Event::postUpdate]
        ];
    }




    /**
     * @inheritDoc
    */
    public function getRemoveEvents(): array
    {
        return [
            PreRemoveEvent::class    => [$this, Event::preRemove],
            PostRemoveEvent::class   => [$this, Event::postRemove],
        ];
    }





    /**
     * @param PrePersistEvent $event
     *
     * @return void
     */
    private function prePersist(PrePersistEvent $event): void
    {
        $this->call($event, Event::prePersist);
    }




    /**
     * @param PostPersistEvent $event
     *
     * @return void
     */
    private function postPersist(PostPersistEvent $event): void
    {
        $this->call($event, Event::postPersist);
    }




    /**
     * @param PreUpdateEvent $event
     *
     * @return void
     */
    private function preUpdate(PreUpdateEvent $event): void
    {
        $this->call($event, Event::preUpdate);
    }





    /**
     * @param PostUpdateEvent $event
     *
     * @return void
     */
    private function postUpdate(PostUpdateEvent $event): void
    {
        $this->call($event, Event::postUpdate);
    }




    /**
     * @param PreRemoveEvent $event
     *
     * @return void
     */
    private function preRemove(PreRemoveEvent $event): void
    {
        $this->call($event, Event::preRemove);
    }




    /**
     * @param PostRemoveEvent $event
     *
     * @return void
     */
    private function postRemove(PostRemoveEvent $event): void
    {
        $this->call($event, Event::postRemove);
    }





    /**
     * @param ObjectEvent $event
     *
     * @param string $method
     *
     * @return void
    */
    private function call(ObjectEvent $event, string $method): void
    {
        $object = $event->getSubject();
    }
}