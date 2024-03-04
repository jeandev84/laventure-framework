<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Configuration;

use Laventure\Component\Database\Configuration\Configuration;

/**
 * ManagerConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\Configuration
*/
class ManagerConfiguration extends Configuration
{
    /**
     * @return string
    */
    public function getConnection(): string
    {
        return $this->get('connection');
    }


    /**
     * @return string
    */
    public function getExtension(): string
    {
        return $this->get('extension');
    }




    /**
     * @return array
    */
    public function getCredentials(): array
    {
        return $this->get('credentials');
    }
}
