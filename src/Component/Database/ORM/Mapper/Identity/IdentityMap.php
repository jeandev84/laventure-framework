<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapper\Identity;

/**
 * IdentityMap
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Identity
*/
class IdentityMap implements IdentityMapperInterface
{
    /**
     * @var array
    */
    protected array $identity = [];





    /**
     * @inheritDoc
    */
    public function map($id, $data): static
    {
        $this->identity[$id] = $data;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function has($id): bool
    {
        return isset($this->identity[$id]);
    }




    /**
     * @inheritDoc
    */
    public function get($id): mixed
    {
        return $this->identity[$id] ?? null;
    }







    /**
     * @inheritDoc
    */
    public function all(): array
    {
        return $this->identity;
    }





    /**
     * @inheritDoc
    */
    public function remove($id): static
    {
        unset($this->identity[$id]);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        $this->identity = [];
    }
}
