<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Configuration;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Utils\Parameter\Parameter;

/**
 * Definition
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Definition
 */
class Configuration extends Parameter implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getUsername(): ?string
    {
        return $this->get('username');
    }





    /**
     * @inheritDoc
     */
    public function getPassword(): ?string
    {
        return $this->get('password');
    }






    /**
     * @inheritDoc
     */
    public function getCharset(): string
    {
        return $this->get('charset', 'utf8');
    }






    /**
     * @inheritDoc
     */
    public function getPrefix(): string
    {
        return $this->get('prefix', '');
    }






    /**
     * @inheritDoc
     */
    public function getHost(): string
    {
        return $this->get('host', '');
    }






    /**
     * @inheritDoc
    */
    public function getPort(): int
    {
        return $this->integer('port');
    }





    /**
     * @inheritDoc
     */
    public function getDatabase(): string
    {
        return $this->get('database', '');
    }





    /**
     * @return string
     */
    public function getCollation(): string
    {
        return $this->get('collation', '');
    }
}
