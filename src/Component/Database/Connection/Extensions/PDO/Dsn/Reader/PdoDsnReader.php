<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Reader;

use Laventure\Contract\Reader\ReaderInterface;

/**
 * PdoDsnReader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Dsn\Reader
*/
class PdoDsnReader implements ReaderInterface
{
    /**
     * @var string
    */
    protected string $dsn;



    /**
     * @var array
    */
    protected array $replaceKeys = [
        'dbname' => 'database'
    ];




    /**
     * @var array|string[]
    */
    protected array $casts = [
        'port' => 'integer'
    ];



    /**
     * @param string $dsn
    */
    public function __construct(string $dsn)
    {
        $this->dsn = $dsn;
    }




    /**
     * @param array $replaceKeys
     * @return $this
    */
    public function withReplaceKeys(array $replaceKeys): static
    {
        $this->replaceKeys = array_merge(
            $this->replaceKeys,
            $replaceKeys
        );

        return $this;
    }




    /**
     * @return string
    */
    public function readAsString(): string
    {
        return $this->dsn;
    }




    /**
     * @inheritDoc
    */
    public function read(): array
    {
        echo $this->dsn, "\n";
        $config = [];
        [$driver, $options] = explode(':', $this->dsn, 2);
        $params = explode(';', $options);
        $config['driver'] = $driver;

        foreach ($params as $param) {
            if (str_contains('=', $param)) {
                [$key, $value] = explode('=', $param, 2);
                if (!empty($value)) {
                    $config[$key] = $value;
                }
            }
        }


        if ($this->replaceKeys) {
            $config = $this->replaceKeys($config);
        }

        if ($this->casts) {
            $config = $this->castKeys($config);
        }

        return array_filter($config);
    }




    /**
     * @param array $config
     * @return array
    */
    private function replaceKeys(array $config): array
    {
        foreach ($this->replaceKeys as $key => $replace) {
            if (!empty($config[$key])) {
                $config[$replace] = $config[$key];
                unset($config[$key]);
            }
        }

        return $config;
    }





    /**
     * @param array $config
     * @return array
    */
    private function castKeys(array $config): array
    {
        foreach ($this->casts as $key => $cast) {
            if (!empty($config[$key])) {
                $callback = [$this, "{$cast}Cast"];
                if (is_callable($callback)) {
                    $config[$key] = call_user_func($callback, $config[$key]);
                }
            }
        }

        return $config;
    }






    /**
     * @param $value
     * @return int
    */
    private function integerCast($value): int
    {
        return intval($value);
    }
}
