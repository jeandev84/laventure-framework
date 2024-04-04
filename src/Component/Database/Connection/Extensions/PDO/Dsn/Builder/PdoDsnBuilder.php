<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;

/**
 * PdoDsnBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Dsn
 */
class PdoDsnBuilder implements PdoDsnBuilderInterface
{
    /**
     * @var string
    */
    private string $driver;


    /**
     * @var array
    */
    private array $params;




    /**
     * @param string $driver
     * @param array $params
    */
    public function __construct(string $driver, array $params)
    {
        $this->driver = $driver;
        $this->params = $params;
    }






    /**
     * @inheritDoc
    */
    public function getDriver(): string
    {
        return $this->driver;
    }




    /**
     * @inheritDoc
    */
    public function withParams(array $params): static
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function withoutParam(string $name): static
    {
        unset($this->params[$name]);

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function withoutParams(array $params): static
    {
        foreach ($params as $param) {
            $this->withoutParam($param);
        }

        return $this;
    }







    /**
     * @inheritDoc
     */
    public function buildDefault(): string
    {
        $this->withoutParam('dbname');

        return $this->build();
    }





    /**
     * @inheritDoc
    */
    public function buildIfDatabaseExists(): string
    {
        return $this->build();
    }







    /**
     * @inheritDoc
    */
    public function getParams(): array
    {
        return $this->params;
    }




    /**
     * @inheritDoc
    */
    public function getParam($key): string
    {
        return $this->params[$key] ?? '';
    }






    /**
     * @inheritDoc
    */
    public function build(): string
    {
        $config = http_build_query(
            $this->params,
            '',
            ';'
        );

        return urldecode("$this->driver:$config");
    }




    /**
     * @return string
    */
    public function __toString(): string
    {
        return $this->build();
    }
}
