<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Types\Pgsql;

use Laventure\Component\Database\Connection\ConnectionName;
use Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Pgsql\PgsqlDatabase;
use Laventure\Component\Database\Connection\Extensions\PDO\PdoConnection;
use Laventure\Component\Database\DatabaseInterface;

/**
 * PgsqlConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Drivers\Pgsql
*/
class PgsqlConnection extends PdoConnection
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return ConnectionName::Pgsql;
    }



    /**
     * @inheritDoc
    */
    public function getDatabase(): DatabaseInterface
    {
        return new PgsqlDatabase($this);
    }

    /**
     * @inheritDoc
     */
    public function activateTransaction(): void
    {
        // TODO: Implement activateTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function disableTransaction(): void
    {
        // TODO: Implement disableTransaction() method.
    }
}
