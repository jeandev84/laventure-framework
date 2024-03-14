<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\ORM\Credentials;

use Laventure\Component\Config\Config;
use Laventure\Component\Config\ConfigInterface;
use Laventure\Foundation\Database\ORM\Exceptions\OrmCredentialsException;

/**
 * OrmCurrentCredentials
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\ORM
*/
class OrmCurrentCredentials
{
    /**
     * @param string $current
     * @param array $credentials
    */
    public function __construct(
        protected string $current,
        protected array $credentials
    ) {
    }




    /**
     * @return bool
    */
    public function hasCredentials(): bool
    {
        return !empty($this->credentials[$this->current]);
    }





    /**
     * @return ConfigInterface
     * @throws OrmCredentialsException
    */
    public function get(): ConfigInterface
    {
        if (!$this->hasCredentials()) {
            throw new OrmCredentialsException("empty ORM config credentials");
        }

        return new Config($this->credentials[$this->current]);
    }





    /**
     * @return string
    */
    public function getCurrent(): string
    {
        return $this->current;
    }





    /**
     * @return array
    */
    public function getCredentials(): array
    {
        return $this->credentials;
    }
}
