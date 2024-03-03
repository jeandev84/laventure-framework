<?php

declare(strict_types=1);

namespace Laventure\Contract\Parameter;

use ArrayAccess;

/**
 * ArrayParameterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Drivers\Parameter
*/
interface ParameterInterface extends ArrayAccess
{
    /**
     * Set value
     *
     * @param $id
     * @param $value
     * @return mixed
    */
    public function set($id, $value): mixed;





    /**
     * Add params
     *
     * @param array $params
     *
     * @return mixed
    */
    public function add(array $params): mixed;





    /**
     * Determine if parameter exist
     *
     * @param $id
     * @return bool
    */
    public function has($id): bool;








    /**
     * Returns count of params
     *
     * @return int
    */
    public function count(): int;






    /**
     * @param $id
     * @param null $default
     * @return mixed
    */
    public function get($id, $default = null): mixed;





    /**
     * @param $id
     *
     * @return mixed
    */
    public function remove($id): mixed;





    /**
     * Returns all params
     *
     * @return array
    */
    public function all(): array;







    /**
     * Returns the value required.
     * If parameter is not defined we'll throw exception
     *
     * @param $key
     * @return mixed
    */
    public function required($key): mixed;







    /**
     * Determine if value empty
     *
     * @param $key
     * @return bool
     */
    public function isEmpty($key): bool;
}
