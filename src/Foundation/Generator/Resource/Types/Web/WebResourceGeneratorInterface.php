<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Types\Web;

use Laventure\Foundation\Generator\Resource\ResourceGeneratorInterface;

/**
 * WebResourceGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource\Web
 */
interface WebResourceGeneratorInterface extends ResourceGeneratorInterface
{
    /**
     * Generate template engine
     *
     * @return bool
    */
    public function generateTemplates(): bool;
}
