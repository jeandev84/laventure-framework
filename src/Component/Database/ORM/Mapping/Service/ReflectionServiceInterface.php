<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Service;

/**
 * ReflectionServiceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Service
*/
interface ReflectionServiceInterface
{
    /**
     * @param $class
     * @return mixed
    */
    public function getParentClasses($class);


    /**
     * @param $class
     * @return mixed
    */
    public function getClassShortName($class);



    /**
     * @param $class
     * @return mixed
    */
    public function getClassNamespace($class);




    /**
     * @param $class
     * @return mixed
    */
    public function getClass($class);




    /**
     * @param $class
     * @param $property
     * @return mixed
    */
    public function getAccessibleProperty($class, $property);





    /**
     * @param $class
     * @param $method
     * @return mixed
    */
    public function hasPublicMethod($class, $method);







    /**
     * @param callable $callback
     * @param array $arguments
     * @return mixed
    */
    public function call(callable $callback, array $arguments): mixed;
}
