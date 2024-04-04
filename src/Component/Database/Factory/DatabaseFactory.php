<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Factory;

/**
 * DatabaseFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Factory
 */
abstract class DatabaseFactory implements DatabaseFactoryInterface
{
    /**
     * @inheritDoc
    */
    public function createDatabases(array $names): array
    {
        return array_map(function (string $name) {
            return $this->createDatabase($name);
        }, $names);
    }
}
