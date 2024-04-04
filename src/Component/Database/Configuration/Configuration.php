<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Configuration;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Utils\Parameter\Parameter;

/**
 * Config
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Config
 */
class Configuration extends Parameter implements ConfigurationInterface
{
    /**
     * @inheritDoc
    */
    public function getUsername(): string
    {
        return $this->required('username');
    }





    /**
     * @inheritDoc
     */
    public function getPassword(): ?string
    {
        return $this->required('password');
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
        return $this->required('host');
    }






    /**
     * @inheritDoc
    */
    public function getPort(): int
    {
        return intval($this->required('port'));
    }





    /**
     * @inheritDoc
     */
    public function getDatabase(): string
    {
        return $this->required('database');
    }





    /**
     * @return string
     */
    public function getCollation(): string
    {
        return $this->get('collation', 'utf8_general_ci');
    }




    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->get('options', []);
    }





    /**
     * @inheritDoc
    */
    public function prefixed($name): string
    {
        return sprintf('%s%s', $this->getPrefix(), $name);
    }





    /**
     * @inheritDoc
    */
    public function getSchemaName(): string
    {
        return $this->get('schemaName', $this->getDatabase());
    }
}
