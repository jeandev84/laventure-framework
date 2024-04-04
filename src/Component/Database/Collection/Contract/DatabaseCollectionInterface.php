<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Collection\Contract;

use Laventure\Component\Database\DatabaseInterface;

/**
 * DatabaseCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Collection
 */
interface DatabaseCollectionInterface
{
    /**
     * @param string $name
     * @return bool
    */
    public function has(string $name): bool;





    /**
     * @param string $name
     * @return DatabaseInterface
    */
    public function get(string $name): DatabaseInterface;






    /**
     * @param DatabaseInterface $database
     * @return $this
    */
    public function add(DatabaseInterface $database): static;






    /**
     * @param DatabaseInterface[] $databases
     * @return $this
    */
    public function collect(array $databases): static;







    /**
     * @return array<string, DatabaseInterface>
    */
    public function all(): array;
}
