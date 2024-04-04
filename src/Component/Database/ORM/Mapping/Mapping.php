<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping;

use Laventure\Contract\Mapping\MappingInterface;
use ReflectionClass;

/**
 * Data
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data
 */
abstract class Mapping implements MappingInterface
{
    /**
     * @param ReflectionClass $class
    */
    public function __construct(
        protected ReflectionClass $class
    )
    {
    }





    /**
     * @param ReflectionClass $class
     * @return static
    */
    public static function create(ReflectionClass $class): static
    {
        return new static($class);
    }
}