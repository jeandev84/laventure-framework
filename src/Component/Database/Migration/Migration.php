<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Migration;

use ReflectionClass;

/**
 * Migration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Migration
*/
abstract class Migration implements MigrationInterface
{
    /**
     * @inheritdoc
    */
    public function getVersion(): string
    {
        return $this->getReflector()->getShortName();
    }





    /**
     * @inheritdoc
    */
    public function getPath(): string
    {
        return $this->getReflector()->getFileName();
    }





    /**
     * @return ReflectionClass
    */
    private function getReflector(): ReflectionClass
    {
        return new ReflectionClass(get_called_class());
    }
}
