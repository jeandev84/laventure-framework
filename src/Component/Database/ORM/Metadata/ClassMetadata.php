<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Metadata;

use ReflectionClass;
use Reflector;

/**
 * ClassMetadata
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Metadata
*/
class ClassMetadata implements ClassMetadataInterface
{


    /**
     * @var ReflectionClass
    */
    protected ReflectionClass $reflector;


    public function __construct($class)
    {
        $this->reflector = new ReflectionClass($class);
    }



    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        return $this->reflector->getName();
    }




    /**
     * @inheritDoc
    */
    public function getReflector(): Reflector
    {
        return $this->reflector;
    }
}
