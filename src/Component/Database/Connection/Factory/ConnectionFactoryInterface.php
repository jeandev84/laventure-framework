<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Factory;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;

/**
 * ConnectionFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Factory
*/
interface ConnectionFactoryInterface
{
    /**
     * @param ConfigurationInterface $config
     *
     * @return mixed
    */
    public function makeConnection(ConfigurationInterface $config): mixed;
}
