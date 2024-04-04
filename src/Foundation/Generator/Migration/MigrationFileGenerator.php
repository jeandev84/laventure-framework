<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Migration;

use Laventure\Foundation\Generator\Class\ClassGenerator;
use Laventure\Foundation\Generator\Class\ClassGeneratorInterface;
use Laventure\Foundation\Generator\Migration\Exception\MigrationGeneratorException;

/**
 * MigrationFileGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Migration
*/
abstract class MigrationFileGenerator extends ClassGenerator implements MigrationFileGeneratorInterface
{
    /**
     * @var string
    */
    protected string $tableName = '';





    /**
     * @var bool
    */
    protected bool $updateStub = false;





    /**
     * @param bool $updateStub
     * @return $this
    */
    public function withUpdateStub(bool $updateStub): static
    {
        $this->updateStub = $updateStub;

        return $this;
    }




    /**
     * @return bool
    */
    public function hasUpdateStub(): bool
    {
        return $this->updateStub;
    }




    /**
     * @inheritDoc
    */
    public function withTableName(string $tableName): static
    {
        $this->tableName = $tableName;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
        if (!$this->tableName) {
            throw new MigrationGeneratorException(
                "No table specified for generator ". get_called_class()
            );
        }

        return $this->tableName;
    }




    /**
     * @inheritDoc
     * @throws MigrationGeneratorException
    */
    public function getContent(): string
    {
        return $this->generateStub([
            "DummyNamespace" => $this->getNamespace(),
            "DummyClassName" => $this->getClassName(),
            "DummyTableName" => $this->getTableName()
        ]);
    }



    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        if ($this->updateStub) {
            return $this->getStubUpdateTable();
        }

        return $this->getStubCreateTable();
    }




    /**
     * @return string
    */
    abstract protected function getStubCreateTable(): string;




    /**
     * @return string
    */
    abstract protected function getStubUpdateTable(): string;
}
