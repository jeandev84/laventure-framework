<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Sqlite\Connection\Dsn\Builder;

use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilder;

/**
 * SqliteDsnBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Drivers\Sqlite\Connection\Dsn\Builder
*/
class SqliteDsnBuilder extends PdoDsnBuilder
{
    /**
     * @return string
    */
    public function build(): string
    {
        return sprintf('%s:%s', $this->getDriver(), $this->getParam('dbname'));
    }





    /**
     * @return string
    */
    public function buildDefault(): string
    {
        return $this->build();
    }
}
