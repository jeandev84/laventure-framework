<?php

declare(strict_types=1);

namespace Laventure\Component\Config;

/**
 * Common
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common
*/
class Config implements ConfigInterface
{
    /**
     * @param array $config
    */
    public function __construct(protected array $config)
    {
    }




    /**
     * @inheritDoc
    */
    public function get(string $name, mixed $default = null): mixed
    {
        $path  = explode('.', $name);
        $value = $this->config[array_shift($path)] ?? null;

        if ($value === null) {
            return $default;
        }

        foreach ($path as $key) {
            if (! isset($value[$key])) {
                return $default;
            }

            $value = $value[$key];
        }

        return $value;
    }





    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->config[$offset]);
    }




    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->config[$offset] = $value;
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->config[$offset]);
    }
}
