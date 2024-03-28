<?php
declare(strict_types=1);

namespace Laventure\Foundation\Database\ORM\Model;


use Laventure\Component\Database\Configuration\Exception\NotFoundConfigurationException;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Exception\NotFoundConnectionException;
use Laventure\Component\Database\Connection\Exception\UnavailableConnectionException;
use Laventure\Component\Database\Manager\Contract\DatabaseManagerInterface;
use Laventure\Component\Database\ORM\ActiveRecord\ActiveRecord;
use Laventure\Foundation\Database\Manager\Exception\ManagerException;
use Laventure\Foundation\Database\Manager\Manager;

/**
 * Model
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\ORM\Model
*/
class Model extends ActiveRecord
{


    /**
     * @var null
    */
    protected $connection = null;




    /**
     * @param $connection
     * @return $this
    */
    public function connection($connection): static
    {
        $this->connection = $connection;

        return $this;
    }





    /**
     * @inheritDoc
     * @return ConnectionInterface
     * @throws ManagerException
     * @throws NotFoundConfigurationException
     * @throws NotFoundConnectionException
     * @throws UnavailableConnectionException
    */
    public function getConnection(): ConnectionInterface
    {
        return Manager::getInstance()->connection($this->connection);
    }
}