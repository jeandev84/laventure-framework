<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Service\Migration;

use Laventure\Component\Database\Schema\Migration\Migration;
use PHPUnitTest\App\Migration\Version202302281534;
use PHPUnitTest\App\Migration\Version202302281676;
use PHPUnitTest\App\Migration\Version202302281678;
use PHPUnitTest\App\Migration\Version202302281689;
use PHPUnitTest\App\Migration\Version202302281721;

/**
 * MigrationStack
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\Migration
 */
class MigrationStack
{
    /**
     * @return Migration[]
    */
    public static function getMigrations(): array
    {
        return [
            new Version202302281689(),
            new Version202302281721(),
            new Version202302281534(),
            new Version202302281676(),
            new Version202302281678()
        ];
    }
}
