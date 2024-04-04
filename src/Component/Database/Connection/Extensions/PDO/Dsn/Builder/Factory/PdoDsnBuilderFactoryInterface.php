<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilderInterface;

/**
 * PdoDsnBuilderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Factory
*/
interface PdoDsnBuilderFactoryInterface
{
    /**
     * @param ConfigurationInterface $config
     * @return PdoDsnBuilderInterface
    */
    public function create(ConfigurationInterface $config): PdoDsnBuilderInterface;
}
