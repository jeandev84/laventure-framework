<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Factory;

use Laventure\Component\Database\DatabaseInterface;

/**
 * DatabaseFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Factory
*/
interface DatabaseFactoryInterface
{
    /**
      * @param string $name
      * @return DatabaseInterface
    */
    public function createDatabase(string $name): DatabaseInterface;



    /**
     * @param array $names
     * @return DatabaseInterface[]
    */
    public function createDatabases(array $names): array;
}
