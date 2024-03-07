<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Migration;

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
    public function getName(): string
    {
        return $this->reflection()->getShortName();
    }





    /**
     * @inheritdoc
    */
    public function getPath(): string
    {
        return $this->reflection()->getFileName();
    }





    /**
     * @return ReflectionClass
    */
    private function reflection(): ReflectionClass
    {
        return new ReflectionClass(get_called_class());
    }
}
