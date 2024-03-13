<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Migration;

use Laventure\Foundation\Generator\Class\ClassGenerator;
use Laventure\Foundation\Generator\Class\ClassGeneratorInterface;

/**
 * MigrationFileGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Migration
*/
abstract class MigrationFileGenerator extends ClassGenerator implements ClassGeneratorInterface
{

    /**
     * @inheritDoc
    */
    public function getBaseNamespace(): string
    {

    }




    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {

    }



    /**
     * @inheritDoc
    */
    public function getBaseDir(): string
    {

    }
}