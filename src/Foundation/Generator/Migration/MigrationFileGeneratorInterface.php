<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Migration;

use Laventure\Foundation\Generator\Class\ClassGeneratorInterface;

/**
 * MigrationFileGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Migration
 */
interface MigrationFileGeneratorInterface extends ClassGeneratorInterface
{
    /**
     * @param string $tableName
     * @return $this
    */
    public function withTableName(string $tableName): static;





    /**
     * @return string
    */
    public function getTableName(): string;
}
