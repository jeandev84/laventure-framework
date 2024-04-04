<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Identifier\Generator\Traits;


use ReflectionClass;
use ReflectionException;

/**
 * identifierGeneratorTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Metadata\Field\Types\Identifier\Generator\Traits
 */
trait identifierGeneratorTrait
{

    /**
     * @param string $from
     * @return string
    */
    public function generateReferenceColumn(string $from): string
    {
        $from    = mb_strtolower($from);
        $lastChar = mb_substr($from, -1);

        if ($lastChar === 's') {
            $from = rtrim($from, $lastChar);
        }

        return "{$from}_id";
    }





    /**
     * @param string $targetEntity
     * @return string
     * @throws ReflectionException
    */
    public function generateFromClass(string $targetEntity): string
    {
          $class = new ReflectionClass($targetEntity);

          return $this->generateReferenceColumn($class->getShortName());
    }
}