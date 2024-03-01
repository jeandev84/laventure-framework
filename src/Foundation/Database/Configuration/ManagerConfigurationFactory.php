<?php
declare(strict_types=1);

namespace Laventure\Foundation\Database\Configuration;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;


/**
 * ManagerConfigurationFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\Configuration
*/
class ManagerConfigurationFactory
{

     /**
      * @param array $credentials
      * @return ConfigurationInterface
     */
     public function create(array $credentials): ConfigurationInterface
     {
         return new Configuration($credentials);
     }
}