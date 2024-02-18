<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Info;


/**
 * ColumnInfoInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Info
*/
interface ColumnInfoInterface
{
    /**
     * @param $id
     * @param $default
     * @return mixed
    */
    public function get($id, $default = null): mixed;



    /**
     * Returns column field name
     *
     * @return string
    */
    public function getField(): string;






    /**
     * Returns column type
     *
     * @return string
    */
    public function getType(): string;






    /**
     * Returns collation
     *
     * @return string
    */
    public function getCollation(): string;







    /**
     * Returns key
     *
     * @return string
    */
    public function getKey(): string;








    /**
     * Returns default value
     *
     * @return mixed
    */
    public function getDefault(): mixed;






    /**
     * Returns extras
     *
     * @return string
    */
    public function getExtra(): string;







    /**
     * Returns privileges
     *
     * @return mixed
    */
    public function getPrivileges(): mixed;







    /**
     * Determine if column is nullable
     *
     * @return bool
    */
    public function isNullable(): bool;
}