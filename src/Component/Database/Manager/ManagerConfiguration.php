<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;

/**
 * ManagerConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\Definition
*/
class ManagerConfiguration extends Configuration
{
    /**
     * @return string
    */
    public function getConnection(): string
    {
        return $this->required('connection');
    }




    /**
     * @return string
    */
    public function getExtension(): string
    {
        return $this->required('extension');
    }




    /**
     * @return array
    */
    public function getCredentials(): array
    {
        return $this->required('credentials', []);
    }





    /**
     * @return array
    */
    public function getConnections(): array
    {
        return $this->required('connections');
    }
}
