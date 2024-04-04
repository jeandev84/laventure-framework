<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Factory;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Utils\Parameter\Parameter;

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
     * @return ColumnInterface
    */
    public function createColumn(string $name): ColumnInterface;





    /**
     * data from the database
     *
     * @param array $data
     * @return ColumnInterface
    */
    public function createFromArray(array $data): ColumnInterface;






    /**
     * Parameter from the database
     *
     * @param Parameter $parameter
     * @return ColumnInterface
    */
    public function createFromParameter(Parameter $parameter): ColumnInterface;
}
