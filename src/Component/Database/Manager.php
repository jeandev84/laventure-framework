<?php
declare(strict_types=1);

namespace Laventure\Component\Database;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Manager\DatabaseManagerInterface;
use Laventure\Component\Database\Manager\Factory\DatabaseManagerFactory;
use Laventure\Component\Database\Migrator\Migrator;
use Laventure\Component\Database\Migrator\MigratorInterface;
use Laventure\Component\Database\ORM\Manager\EntityManager;
use Laventure\Component\Database\ORM\Manager\EntityManagerInterface;
use Laventure\Component\Database\ORM\Repository\EntityRepositoryInterface;
use Laventure\Component\Database\Schema\Schema;
use Laventure\Component\Database\Schema\SchemaInterface;

/**
 * Manager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database
*/
class Manager
{

     /**
      * @var static
     */
     protected static $instance;


     /**
      * @var DatabaseManagerInterface
     */
     protected DatabaseManagerInterface $manager;



     /**
      * @var EntityManagerInterface
     */
     protected EntityManagerInterface $em;


     public function __construct()
     {
         $this->manager  = DatabaseManagerFactory::create();
     }






     /**
      * @param string $name
      * @param ConfigurationInterface $config
      * @return $this
     */
     public function open(string $name, ConfigurationInterface $config): static
     {
         $this->manager->open($name, $config);

         return $this;
     }





     /**
      * @param string|null $name
      * @return ConnectionInterface
     */
     public function connection(string $name = null): ConnectionInterface
     {
         return $this->manager->connection($name);
     }





     /**
      * @param EntityManagerInterface $em
      * @return $this
     */
     public function setEntityManager(EntityManagerInterface $em): static
     {
         $this->em = $em;

         return $this;
     }




     /**
      * @return EntityManagerInterface
     */
     public function getEntityManager(): EntityManagerInterface
     {
          return $this->em;
     }





     /**
      * @param string $classname
      * @return EntityRepositoryInterface
     */
     public function getRepository(string $classname): EntityRepositoryInterface
     {
         return $this->getEntityManager()->getRepository($classname);
     }







     /**
      * @param string|null $name
      * @return SchemaInterface
     */
     public function schema(string $name = null): SchemaInterface
     {
         return new Schema($this->connection($name));
     }





     /**
      * @param string|null $name
      * @return MigratorInterface
     */
     public function migration(string $name = null): MigratorInterface
     {
          return new Migrator($this->connection($name));
     }







     /**
      * @return void
     */
     public function close(): void
     {
         $this->manager->close();
     }





    /**
     * @return static
    */
    public static function instance(): static
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}