<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Contract;


use Laventure\Component\Database\Manager\Config\ManagerConfiguration;
use Laventure\Component\Database\Manager\Config\ManagerConfigurationInterface;
use Laventure\Component\Database\Schema\Migrator\MigratorInterface;
use Laventure\Component\Database\Schema\SchemaInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * ManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Contract
*/
interface ManagerInterface extends DatabaseManagerInterface
{

      /**
       * Add global credentials
       *
       * @param array $credentials
       * @return mixed
      */
      public function addCredentials(array $credentials): mixed;



      
      /**
       * Run manager
       *
       * @return mixed
      */
      public function bootManager(): mixed;







      /**
       * Returns table instance by given name
       *
       * @param string $name
       * @param string|null $connection
       * @return TableInterface
      */
      public function table(string $name, string $connection = null): TableInterface;






     /**
      * Returns schema instance by connection
      *
      * @param string|null $connection
      * @return SchemaInterface
     */
     public function schema(string $connection = null): SchemaInterface;







     /**
      * Returns instance of migrator by connection
      *
      * @param string|null $connection
      * @return MigratorInterface
     */
     public function migration(string $connection = null): MigratorInterface;









    /**
     * Returns all manager credentials
     *
     * @return ManagerConfigurationInterface
    */
    public function getConfiguration(): ManagerConfigurationInterface;
}