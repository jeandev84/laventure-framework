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
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Reader
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
    protected array $replaceKeys = [];



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
        $this->replaceKeys = $replaceKeys;

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
        $config = [];
        [$driver, $options] = explode(':', $this->dsn, 2);
        $params = explode(';', $options);
        $config['driver'] = $driver;

        foreach ($params as $attributes) {
            [$key, $value] = explode('=', $attributes);
            $config[$key] = $value;
        }

        if ($this->replaceKeys) {
            foreach ($this->replaceKeys as $key => $replace) {
                if (!empty($config[$key])) {
                    $config[$replace] = $config[$key];
                    unset($config[$key]);
                }
            }
        }

        return $config;
    }
}