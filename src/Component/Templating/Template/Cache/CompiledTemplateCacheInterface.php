<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Cache;

use Laventure\Component\Templating\Template\Compiler\CompiledTemplateInterface;

/**
 * CompiledTemplateCacheInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Caching
 */
interface CompiledTemplateCacheInterface
{
    /**
     * Caching compiled template
     *
     * @param CompiledTemplateInterface $compiledTemplate
     *
     * @return CachedTemplateInterface;
    */
    public function cache(CompiledTemplateInterface $compiledTemplate): CachedTemplateInterface;
}
