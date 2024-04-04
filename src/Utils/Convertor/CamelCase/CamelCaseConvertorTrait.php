<?php

declare(strict_types=1);

namespace Laventure\Utils\Convertor\CamelCase;

/**
 * CamelCaseConvertorTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Utils\Convertor\CamelCase
*/
trait CamelCaseConvertorTrait
{
    /**
     * Example:
     * Transform authorId to author_id
     *
     * @param string $source
     * @return string
    */
    public function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }






    /**
     * @param string $source
     * @return string
    */
    public function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
}
