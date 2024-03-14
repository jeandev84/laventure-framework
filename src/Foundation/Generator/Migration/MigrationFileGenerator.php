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
        dd($this->tableName);
        if (!$this->tableName) {
            throw new MigrationGeneratorException(
        "No table specified for generator ". get_called_class()
            );
        }

        return $this->tableName;
    }
}
