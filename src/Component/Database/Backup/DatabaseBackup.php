<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Backup;

use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * DatabaseBackup
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Backup
*/
class DatabaseBackup implements DatabaseBackupInterface
{
    /**
     * @param ConnectionInterface $connection
     * @param string $database
    */
    public function __construct(
        protected ConnectionInterface $connection,
        protected string $database
    ) {
    }



    /**
     * @inheritDoc
    */
    public function backupTo(string $filepath): static
    {
        $this->connection->executeQuery(
            sprintf("BACKUP DATABASE %s TO DISK = '%s'", $this->database, $filepath)
        );

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function backupDiff(string $filepath): static
    {
        $this->connection->executeQuery(
            sprintf("BACKUP DATABASE %s TO DISK = '%s' WITH DIFFERENTIAL", $this->database, $filepath)
        );

        return $this;
    }
}
