<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Schema\Column\ColumnInterface;

/**
 * BlueprintInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint
*/
interface BlueprintInterface
{
    /**
     * @return mixed
    */
    public function id(): mixed;




    /**
     * @param $name
     * @return mixed
    */
    public function increments($name): mixed;






    /**
     * @param $name
     * @return ColumnInterface
    */
    public function string($name): ColumnInterface;





    /**
     * @param $name
     * @return mixed
    */
    public function datetime($name): mixed;





    /**
     * @param $name
     * @param $type
     * @param $default
     * @return ColumnInterface
    */
    public function addColumn($name, $type, $default = null): ColumnInterface;





    /**
     * @param $name
     * @return mixed
    */
    public function dropColumn($name): mixed;





    /**
     * @param $name
     * @param $to
     * @return mixed
    */
    public function renameColumn($name, $to): mixed;






    /**
     * @return mixed
    */
    public function create(): mixed;






    /**
     * @return mixed
    */
    public function update(): mixed;







    /**
     * @return mixed
    */
    public function drop(): mixed;
}
