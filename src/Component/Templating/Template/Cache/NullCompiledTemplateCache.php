<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Cache;

use Laventure\Component\Templating\Template\Compiler\CompiledTemplateInterface;

/**
 * NullCompiledTemplateCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Cache
 */
class NullCompiledTemplateCache implements CompiledTemplateCacheInterface
{
    /**
     * @inheritDoc
    */
    public function cache(CompiledTemplateInterface $compiledTemplate): CachedTemplateInterface
    {
        return new CachedTemplate($compiledTemplate->getTemplate(), '');
    }
}
