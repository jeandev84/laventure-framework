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
     * @param string $constraints
     * @return ColumnInterface
    */
    public function createColumn(
        string $name,
        string $type = '',
        string $constraints = ''
    ): ColumnInterface;




    /**
     * Create column from info
     *
     * @param ColumnInfoInterface $info
     * @return ColumnInterface
    */
    public function createColumnFromInfo(ColumnInfoInterface $info): ColumnInterface;
}