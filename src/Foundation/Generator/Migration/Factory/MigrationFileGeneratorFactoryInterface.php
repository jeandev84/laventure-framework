<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Migration\Factory;

use Laventure\Foundation\Generator\Migration\MigrationFileGeneratorInterface;

/**
 * MigrationFileGeneratorFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Migration\Factory
 */
interface MigrationFileGeneratorFactoryInterface
{

    /**
     * @param string $tableName
     * @param string|null $type
     * @return MigrationFileGeneratorInterface
    */
    public function createGenerator(
        string $tableName,
        string $type = null
    ): MigrationFileGeneratorInterface;
}
