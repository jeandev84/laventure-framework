<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Factory;

use Laventure\Foundation\Generator\Resource\ResourceGeneratorInterface;

/**
 * ResourceGeneratorFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource\Factory
 */
interface ResourceGeneratorFactoryInterface
{
    /**
     * @param string $type
     * @return ResourceGeneratorInterface
    */
    public function createResourceGenerator(
        string $type
    ): ResourceGeneratorInterface;
}
