<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Dsn;

use ArrayAccess;
use Stringable;

/**
 * PdoDsn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Dsn
*/
class PdoDsn implements Stringable, ArrayAccess
{
    protected string $dsn;


    /**
     * @var array
    */
    public array $params = [];



    /**
     * @param string $dsn
    */
    public function __construct(string $dsn)
    {
        $this->parseOptions($dsn);
    }





    /**
     * @param $key
     * @param $default
     * @return mixed
    */
    public function get($key, $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }





    /**
     * @return array
    */
    public function toArray(): array
    {
        return $this->params;
    }





    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->dsn;
    }




    /**
     * @param string $dsn
     * @return void
    */
    private function parseOptions(string $dsn): void
    {
        [$driver, $options] = explode(':', $dsn, 2);
        $params = explode(';', $options);
        $this->params['driver'] = $driver;

        foreach ($params as $attributes) {
            [$key, $value] = explode('=', $attributes, 2);
            $this->params[$key] = $value;
        }

        $this->dsn = $dsn;
    }




    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->params[$offset]);
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
        $this->params[$offset] = $value;
    }



    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->params[$offset]);
    }
}
