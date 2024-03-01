<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints;

use Laventure\Traits\Options\HasOptionsTrait;

/**
 * Constraint
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints
*/
class Constraint implements ConstraintInterface
{
    use HasOptionsTrait;


    /**
     * @param string $type
     * @param string|null $key
    */
    public function __construct(
        protected string $type,
        protected ?string $key = null
    ) {
    }


    /**
     * @param string $type
     * @return $this
    */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getType(): string
    {
        return $this->type;
    }



    /**
     * @inheritDoc
    */
    public function getKey(): ?string
    {
        return $this->key;
    }





    /**
     * @inheritdoc
    */
    public function getSQL(): string
    {
        if (!$this->key) {
            return '';
        }

        return sprintf('CONSTRAINT %s', $this->key);
    }





    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }
}
