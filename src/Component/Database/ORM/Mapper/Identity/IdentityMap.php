<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapper\Identity;

use Laventure\Component\Database\ORM\Persistence\Storage\ObjectStorage;
use SplObjectStorage;


/**
 * IdentityMap
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Mapper\Identity
*/
class IdentityMap implements IdentityMapperInterface
{

    /**
     * @param SplObjectStorage $storage
    */
    public function __construct(protected SplObjectStorage $storage)
    {
    }



    /**
     * @inheritDoc
    */
    public function map($id, $data): static
    {
        $this->storage->attach($data, $id);

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function has($id): bool
    {
        return $this->storage->contains($id);
    }



    /**
     * @inheritDoc
    */
    public function get($id): mixed
    {
        return $this->storage[$id];
    }






    /**
     * @inheritDoc
    */
    public function getIdentityId($class, $id): string
    {
        return "{$class}.{$id}";
    }
}