<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Factory;


use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * ConnectionFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Factory
*/
interface ConnectionFactoryInterface
{

      /**
       * @param string $name
       * @param ConfigurationInterface $config
       * @return ConnectionInterface
      */
      public function make(
          string                 $name,
          ConfigurationInterface $config
      ): ConnectionInterface;




      /**
       * @param ConfigurationInterface $config
       *
       * @return mixed
      */
      public function makeConnection(ConfigurationInterface $config): mixed;
}