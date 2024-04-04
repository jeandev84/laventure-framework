<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapper\Data;

/**
 * RowMapperInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Manager\Data
 */
interface RowMapperInterface
{
    /**
     * @param object $object
     * @return array
    */
    public function mapRows(object $object): array;
}
