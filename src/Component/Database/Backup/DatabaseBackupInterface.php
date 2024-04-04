<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Backup;

/**
 * DatabaseBackupInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Dump
*/
interface DatabaseBackupInterface
{
    /**
     * Full back up of an existing SQL database
     *
     * @param string $filepath
     * @return mixed
    */
    public function backupTo(string $filepath): mixed;





    /**
     * Back up only the parts of the database
     * that have changed since the last full database backup
     *
     * @param string $filepath
     * @return mixed
    */
    public function backupDiff(string $filepath): mixed;
}
