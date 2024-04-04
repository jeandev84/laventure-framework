<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Migration\Model;

use Laventure\Foundation\Generator\Migration\MigrationFileGenerator;

/**
 * ActiveRecordMigrationGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Migration\Model
 */
class ModelMigrationGenerator extends MigrationFileGenerator
{
    /**
     * @inheritDoc
     */
    public function getNamespace(): string
    {
        // TODO: Implement getNamespace() method.
    }


    /**
     * @inheritDoc
     */
    public function getBaseDir(): string
    {
        // TODO: Implement getBaseDir() method.
    }

    /**
     * @inheritDoc
     */
    protected function getStubCreateTable(): string
    {
        // TODO: Implement getStubCreateTable() method.
    }

    /**
     * @inheritDoc
     */
    protected function getStubUpdateTable(): string
    {
        // TODO: Implement getStubUpdateTable() method.
    }
}
