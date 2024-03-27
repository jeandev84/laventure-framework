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
     * Add main
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
     * Returns count of main
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
     * Returns all main
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






    /**
     * @return array
     */
    public function keys(): array;







    /**
     * @param $id
     * @param int $default
     * @return int
    */
    public function integer($id, int $default = 0): int;





    /**
     * @param $id
     * @param string $default
     * @return string
     */
    public function string($id, string $default = ''): string;





    /**
     * @param $id
     * @param float $default
     * @return float
     */
    public function float($id, float $default = 0): float;





    /**
     * @param $id
     * @param bool $default
     * @return bool
    */
    public function boolean($id, bool $default = false): bool;




    /**
     * @param string $id
     *
     * @return string
    */
    public function toUpper(string $id): string;




    /**
     * @param string $id
     *
     * @return string
    */
    public function toLower(string $id): string;






    /**
     * @param $id
     * @param $search
     * @param $replace
     * @return array|mixed|string|string[]
    */
    public function replace($id, $search, $replace): mixed;





    /**
     * @param $id
     * @param $value
     * @return bool
    */
    public function eq($id, $value): bool;





    /**
     * @return void
    */
    public function clear(): void;
}
