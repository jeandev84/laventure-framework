<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\SqlServer\Schema\Column;

use Laventure\Component\Database\Schema\Column\AbstractColumn;

/**
 * SQlServerColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\SqlServer
*/
class SQlServerColumn extends AbstractColumn
{
    /**
     * @inheritDoc
     */
    public function increments(): static
    {
        // TODO: Implement increments() method.
    }

    /**
     * @inheritDoc
     */
    public function bigIncrements(): static
    {
        // TODO: Implement bigIncrements() method.
    }

    /**
     * @inheritDoc
     */
    public function integer(int $length = 11): static
    {
        // TODO: Implement integer() method.
    }

    /**
     * @inheritDoc
     */
    public function smallInteger(): static
    {
        // TODO: Implement smallInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function bigInteger(): static
    {
        // TODO: Implement bigInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumInteger(): static
    {
        // TODO: Implement mediumInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyInteger(): static
    {
        // TODO: Implement tinyInteger() method.
    }

    /**
     * @inheritDoc
     */
    public function char($value): static
    {
        // TODO: Implement char() method.
    }

    /**
     * @inheritDoc
     */
    public function datetime(): static
    {
        // TODO: Implement datetime() method.
    }

    /**
     * @inheritDoc
     */
    public function time(): static
    {
        // TODO: Implement time() method.
    }

    /**
     * @inheritDoc
     */
    public function timestamp(): static
    {
        // TODO: Implement timestamp() method.
    }

    /**
     * @inheritDoc
     */
    public function binary(): static
    {
        // TODO: Implement binary() method.
    }

    /**
     * @inheritDoc
     */
    public function date(): static
    {
        // TODO: Implement date() method.
    }

    /**
     * @inheritDoc
     */
    public function decimal(int $precision, int $scale): static
    {
        // TODO: Implement decimal() method.
    }

    /**
     * @inheritDoc
     */
    public function double(int $precision, int $scale): static
    {
        // TODO: Implement double() method.
    }

    /**
     * @inheritDoc
     */
    public function enum(array $values): static
    {
        // TODO: Implement enum() method.
    }

    /**
     * @inheritDoc
     */
    public function float(): static
    {
        // TODO: Implement float() method.
    }

    /**
     * @inheritDoc
     */
    public function json(): static
    {
        // TODO: Implement json() method.
    }

    /**
     * @inheritDoc
     */
    public function longText(): static
    {
        // TODO: Implement longText() method.
    }

    /**
     * @inheritDoc
     */
    public function mediumText(): static
    {
        // TODO: Implement mediumText() method.
    }

    /**
     * @inheritDoc
     */
    public function tinyText(): static
    {
        // TODO: Implement tinyText() method.
    }

    /**
     * @inheritDoc
     */
    public function morphs(): static
    {
        // TODO: Implement morphs() method.
    }

    /**
     * @inheritDoc
     */
    public function signed(): static
    {
        // TODO: Implement signed() method.
    }

    /**
     * @inheritDoc
     */
    public function unsigned(): static
    {
        // TODO: Implement unsigned() method.
    }
}
