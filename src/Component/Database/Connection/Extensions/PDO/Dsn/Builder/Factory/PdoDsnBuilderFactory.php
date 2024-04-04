<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilder;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilderInterface;

/**
 * PdoDsnBuilderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory
*/
class PdoDsnBuilderFactory implements PdoDsnBuilderFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function create(ConfigurationInterface $config): PdoDsnBuilderInterface
    {
        return new PdoDsnBuilder(
            $config->required('driver'),
            [
                'host'     => $config->getHost(),
                'port'     => $config->getPort(),
                'dbname'   => $config->getDatabase(),
                'charset'  => $config->getCharset()
            ]
        );
    }
}
