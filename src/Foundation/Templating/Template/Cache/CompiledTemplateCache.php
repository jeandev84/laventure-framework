<?php

declare(strict_types=1);

namespace Laventure\Foundation\Templating\Template\Cache;

use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Templating\Template\Cache\CachedTemplate;
use Laventure\Component\Templating\Template\Cache\CachedTemplateInterface;
use Laventure\Component\Templating\Template\Cache\CompiledTemplateCacheInterface;
use Laventure\Component\Templating\Template\Cache\Exception\TemplateCacheException;
use Laventure\Component\Templating\Template\Compiler\CompiledTemplateInterface;

/**
 * TemplateCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Templating\Template\Cache
 */
class CompiledTemplateCache implements CompiledTemplateCacheInterface
{

    /**
     * @param Filesystem $filesystem
    */
    public function __construct(
        protected Filesystem $filesystem
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function cache(CompiledTemplateInterface $compiledTemplate): CachedTemplateInterface
    {
        try {

            $template  = $compiledTemplate->getTemplate();
            $cacheKey  = $template->getCacheKey();
            $cachePath = $this->filesystem->dump($cacheKey .'.php', strval($compiledTemplate));
            return new CachedTemplate($template, $cachePath);

        } catch (\Throwable $e) {
            throw new TemplateCacheException($e->getMessage());
        }
    }
}
