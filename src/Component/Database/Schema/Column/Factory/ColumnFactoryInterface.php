<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Factory;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Info\ColumnInfoInterface;

/**
 * ColumnFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Factory
 */
interface ColumnFactoryInterface
{
    /**
     * @param string $name
     * @param string $type
     * @param array $options
     * @return ColumnInterface
    */
    public function createColumn(
        string $name,
        string $type,
        array $options = []
    ): ColumnInterface;
}
