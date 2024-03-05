<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Metadata;

use ReflectionClass;
use ReflectionException;
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
    protected ReflectionClass $reflection;



    /**
     * @var string|object
    */
    protected $class;



    /**
     * @param $class
     * @throws ReflectionException
    */
    public function __construct($class)
    {
        $this->reflection = new ReflectionClass($class);
        $this->class      = $class;
    }



    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->reflection->getName();
    }




    /**
     * @inheritDoc
    */
    public function getReflector(): Reflector
    {
        return $this->reflection;
    }
}
