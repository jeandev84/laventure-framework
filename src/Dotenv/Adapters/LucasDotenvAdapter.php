<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Adapters;

use Laventure\Dotenv\Contract\DotenvInterface;

/**
 * LucasDotenvAdapter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Adapters
 */
class LucasDotenvAdapter implements DotenvInterface
{
    /**
     * @inheritDoc
     */
    public function load(): bool
    {
        return false;
    }
}
