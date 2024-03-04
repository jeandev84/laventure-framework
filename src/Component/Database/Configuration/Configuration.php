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
    public function username(): ?string
    {
        return $this->get('username');
    }





    /**
     * @inheritDoc
     */
    public function password(): ?string
    {
        return $this->get('password');
    }






    /**
     * @inheritDoc
     */
    public function charset(): string
    {
        return $this->get('charset', 'utf8');
    }






    /**
     * @inheritDoc
     */
    public function prefix(): string
    {
        return $this->get('prefix', '');
    }






    /**
     * @inheritDoc
     */
    public function host(): string
    {
        return $this->get('host', '');
    }






    /**
     * @inheritDoc
    */
    public function port(): int
    {
        return $this->integer('port');
    }





    /**
     * @inheritDoc
     */
    public function database(): string
    {
        return $this->get('database', '');
    }





    /**
     * @return string
     */
    public function collation(): string
    {
        return $this->get('collation', '');
    }
}
