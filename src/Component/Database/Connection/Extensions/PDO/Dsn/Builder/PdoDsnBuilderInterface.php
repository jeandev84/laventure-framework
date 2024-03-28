<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder;

use Laventure\Contract\Builder\BuilderInterface;
use Stringable;

/**
 * PdoDsnBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Client\PDO\Dsn
*/
interface PdoDsnBuilderInterface extends BuilderInterface, Stringable
{
    /**
     * @return string
    */
    public function getDriver(): string;






    /**
     * @param array $params
     * @return $this
    */
    public function withoutParams(array $params): static;






    /**
     * @param string $name
     * @return $this
    */
    public function withoutParam(string $name): static;








    /**
     * @param array $params
     * @return $this
    +*/
    public function withParams(array $params): static;








    /**
     * @return array
    */
    public function getParams(): array;






    /**
     * @param $key
     * @return string
    */
    public function getParam($key): string;





    /**
     * Build dsn if database exist
     *
     * @return string
    */
    public function buildDefault(): string;







    /**
     * Build dsn with existent database
     *
     * @return string
    */
    public function buildIfDatabaseExists(): string;
}
