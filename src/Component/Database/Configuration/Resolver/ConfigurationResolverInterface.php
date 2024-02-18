<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Configuration\Resolver;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;

/**
 * ConfigurationResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Configuration\Resolver
*/
interface ConfigurationResolverInterface
{


    /**
     * @param ConfigurationInterface $config
     * @return ConfigurationInterface
    */
    public function resolve(ConfigurationInterface $config): ConfigurationInterface;
}
