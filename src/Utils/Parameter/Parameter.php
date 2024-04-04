<?php

declare(strict_types=1);

namespace Laventure\Utils\Parameter;

use Laventure\Contract\Parameter\ParameterInterface;
use Laventure\Utils\Parameter\Exception\BlankParameterException;
use RuntimeException;

/**
 * Parameter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Utils\Params
*/
class Parameter implements ParameterInterface
{
    /**
     * @var array
    */
    protected array $params = [];



    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        $this->add($params);
    }




    /**
     * @inheritDoc
    */
    public function set($id, $value): static
    {
        $this->params[$id] = $value;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function add(array $params): static
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function has($id): bool
    {
        return isset($this->params[$id]);
    }






    /**
     * @return bool
    */
    public function empty(): bool
    {
        return empty($this->params);
    }





    /**
     * @param string $key
     * @return bool
    */
    public function isEmpty($key): bool
    {
        return empty($this->params[$key]);
    }






    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return count($this->params);
    }




    /**
     * @inheritDoc
    */
    public function get($id, $default = null): mixed
    {
        return $this->params[$id] ?? $default;
    }




    /**
     * @inheritDoc
    */
    public function remove($id): bool
    {
        unset($this->params[$id]);

        return $this->has($id);
    }






    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return $this->params;
    }








    /**
     * @return array
     */
    public function keys(): array
    {
        return array_keys($this->params);
    }





    /**
     * @return void
    */
    public function clear(): void
    {
        foreach ($this->keys() as $name) {
            $this->remove($name);
        }
    }







    /**
     * @param $id
     * @param int $default
     * @return int
     */
    public function integer($id, int $default = 0): int
    {
        return intval($this->get($id, $default));
    }





    /**
     * @param $id
     * @param string $default
     * @return string
     */
    public function string($id, string $default = ''): string
    {
        return strval($this->get($id, $default));
    }





    /**
     * @param $id
     * @param float $default
     * @return float
     */
    public function float($id, float $default = 0): float
    {
        return floatval($this->get($id, $default));
    }






    /**
     * @param $id
     * @param bool $default
     * @return bool
     */
    public function boolean($id, bool $default = false): bool
    {
        return boolval($this->get($id, $default));
    }




    /**
     * @param string $id
     *
     * @return string
     */
    public function toUpper(string $id): string
    {
        return strtoupper($this->string($id));
    }





    /**
     * @param string $id
     *
     * @return string
     */
    public function toLower(string $id): string
    {
        return strtolower($this->string($id));
    }







    /**
     * @param $id
     * @param $search
     * @param $replace
     * @return array|mixed|string|string[]
     */
    public function replace($id, $search, $replace): mixed
    {
        return str_replace($search, $replace, $this->get($id));
    }






    /**
     * @param $id
     * @param $value
     * @return bool
    */
    public function eq($id, $value): bool
    {
        return $this->get($id) === $value;
    }






    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }




    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }





    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }




    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }






    /**
     * @inheritDoc
     * @throws BlankParameterException
    */
    public function required($key): mixed
    {
        if ($this->isEmpty($key)) {
            throw new BlankParameterException($key);
        }

        return $this->get($key);
    }






    /**
     * @param $id
     * @param $value
     * @return bool
    */
    public function match($id, $value): bool
    {
        return $this->get($id) === $value;
    }
}
