<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Config;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\ORM\Manager\Event\EventManager;
use Laventure\Component\Database\ORM\Manager\Event\EventManagerInterface;
use Laventure\Component\Database\ORM\Manager\UnitOfWork\Factory\UnitOfWorkFactory;
use Laventure\Component\Database\ORM\Mapping\Factory\ClassMetadataFactory;
use Laventure\Component\Database\ORM\Mapping\Factory\ClassMetadataFactoryInterface;
use Laventure\Component\Database\ORM\Mapping\Service\ReflectionService;
use Laventure\Component\Database\ORM\Mapping\Service\ReflectionServiceInterface;
use Laventure\Component\Database\ORM\UnitOfWork\Factory\UnitOfWorkFactoryInterface;

/**
 * Config
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager
 */
class Config implements Configuration
{
    /**
     * @var ConnectionInterface
    */
    protected ConnectionInterface $connection;



    /**
     * @var UnitOfWorkFactoryInterface
    */
    protected UnitOfWorkFactoryInterface $unitOfWorkFactory;



    /**
     * @var ClassMetadataFactoryInterface
    */
    protected ClassMetadataFactoryInterface $metadataFactory;





    /**
     * @var EventManagerInterface|null
    */
    protected ?EventManagerInterface $eventManager = null;






    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection        = $connection;
        $this->metadataFactory   = new ClassMetadataFactory();
        $this->unitOfWorkFactory = new UnitOfWorkFactory();
    }




    /**
     * @inheritDoc
    */
    public function getConnection(): ConnectionInterface
    {
        return $this->connection;
    }





    /**
     * @param UnitOfWorkFactoryInterface $unitOfWorkFactory
     * @return $this
    */
    public function withUnitOfWorkFactory(UnitOfWorkFactoryInterface $unitOfWorkFactory): static
    {
        $this->unitOfWorkFactory = $unitOfWorkFactory;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getUnitOfWorkFactory(): UnitOfWorkFactoryInterface
    {
        return $this->unitOfWorkFactory;
    }







    /**
     * @param EventManagerInterface $eventManager
     * @return $this
    */
    public function withEventManager(EventManagerInterface $eventManager): static
    {
        $this->eventManager = $eventManager;

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function getEventManager(): EventManagerInterface
    {
        if (!$this->eventManager) {
            $this->eventManager = new EventManager(
                $this->getReflectionService()
            );
        }

        return $this->eventManager;
    }







    /**
     * @inheritDoc
    */
    public function getClassMetadataFactory(): ClassMetadataFactoryInterface
    {
        return $this->metadataFactory;
    }






    /**
     * @inheritDoc
    */
    public function getReflectionService(): ReflectionServiceInterface
    {
        return new ReflectionService($this->metadataFactory);
    }
}
