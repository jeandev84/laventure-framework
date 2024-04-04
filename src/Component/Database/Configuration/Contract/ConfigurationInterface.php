<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Configuration\Contract;

use Laventure\Contract\Parameter\ParameterInterface;

/**
 * ConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Config\Drivers
 */
interface ConfigurationInterface extends ParameterInterface
{
    /**
     * Returns host name
     *
     * @return string
    */
    public function getHost(): string;






    /**
     * Returns connection user
     *
     * @return string|null
     */
    public function getUsername(): ?string;






    /**
     * Returns connection password
     *
     * @return string|null
     */
    public function getPassword(): ?string;






    /**
     * Returns port
     *
     * @return int
     */
    public function getPort(): int;







    /**
     * Returns name of database
     *
     * @return string
     */
    public function getDatabase(): string;







    /**
     * Returns database encoding characters
     *
     * @return string
     */
    public function getCharset(): string;







    /**
     * Returns collation
     *
     * @return string
     */
    public function getCollation(): string;






    /**
     * Returns table prefix
     *
     * @return string
     */
    public function getPrefix(): string;







    /**
     * Returns connection options
     *
     * @return array
    */
    public function getOptions(): array;






    /**
     * Returns schema name
     *
     * @return string
    */
    public function getSchemaName(): string;








    /**
     * @param $name
     * @return string
    */
    public function prefixed($name): string;
}
