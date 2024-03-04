<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Config;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;

/**
 * PdoConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Config
*/
class PdoConfiguration extends Configuration
{
       public function __construct(array $params)
       {
           parent::__construct($params);
       }




       /**
        * @param $driver
        * @param array $params
        * @return $this
       */
       public function setDsn($driver, array $params): static
       {
            return $this->set('dsn', PdoDsnBuilder::create($driver, $params));
       }
}