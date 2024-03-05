<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Common;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Traits\ConnectionTrait;

/**
 * AbstractConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Common
*/
abstract class AbstractConnection implements ConnectionInterface
{

    use ConnectionTrait;



    /**
     * @param ConfigurationInterface $config
     * @return $this
    */
    public function connect(ConfigurationInterface $config): static
    {
        $this->connectWithoutDatabase($config);

        if ($this->getDatabase()->exists()) {
            $this->connectIfExistsDatabase($config);
        }

        return $this;
    }






    /**
     * Connection without database for example
     *
     * @param ConfigurationInterface $config
     * @return $this
    */
    abstract public function connectWithoutDatabase(ConfigurationInterface $config): static;






    /**
     * Connection to the database if exists
     *
     * @param ConfigurationInterface $config
     * @return $this
    */
    abstract public function connectIfExistsDatabase(ConfigurationInterface $config): static;
}