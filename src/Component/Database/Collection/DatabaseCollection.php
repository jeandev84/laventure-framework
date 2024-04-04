<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Collection;

use Laventure\Component\Database\Collection\Contract\DatabaseCollectionInterface;
use Laventure\Component\Database\Collection\Exception\DatabaseCollectionException;
use Laventure\Component\Database\DatabaseInterface;

/**
 * DatabaseCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Collection
*/
class DatabaseCollection implements DatabaseCollectionInterface
{
    /**
     * @var array<string, DatabaseInterface>
    */
    protected array $databases = [];




    /**
     * @param array $databases
    */
    public function __construct(array $databases = [])
    {
        $this->collect($databases);
    }





    /**
     * @inheritDoc
    */
    public function has(string $name): bool
    {
        return isset($this->databases[$name]);
    }






    /**
     * @inheritDoc
    */
    public function add(DatabaseInterface $database): static
    {
        $this->databases[$database->getName()] = $database;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return $this->databases;
    }





    /**
     * @inheritDoc
    */
    public function collect(array $databases): static
    {
        foreach ($databases as $database) {
            $this->add($database);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function get(string $name): DatabaseInterface
    {
        if (!$this->has($name)) {
            throw new DatabaseCollectionException(
                "Database '$name' is not in collections."
            );
        }

        return $this->databases[$name];
    }
}
