<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Sqlite\Connection\Dsn\Factory;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\Factory\PdoDsnBuilderFactory;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilderInterface;
use Laventure\Component\Database\Drivers\Sqlite\Connection\Dsn\Builder\SqliteDsnBuilder;

/**
 * SqliteDsnBuilderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Sqlite\Connection\Dsn\Factory
*/
class SqliteDsnBuilderFactory extends PdoDsnBuilderFactory
{
    public function create(ConfigurationInterface $config): PdoDsnBuilderInterface
    {
        return new SqliteDsnBuilder($config->required('driver'), [
            'dbname' => $config->getDatabase(),
        ]);
    }
}
