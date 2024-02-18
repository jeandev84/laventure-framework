<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Dsn;

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
class PdoDsn implements Stringable
{

    /**
     * @var string
    */
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
        $this->dsn = $dsn;
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
    }

}