<?php

declare(strict_types=1);

namespace Laventure\Foundation\Templating\Template\Cache;

use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\File\Locator\FileLocator;
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
     * @var FileLocator
    */
    protected FileLocator $fileLocator;


    /**
     * @param string $cachePath
    */
    public function __construct(string $cachePath)
    {
        $this->fileLocator = new FileLocator($cachePath);
    }



    /**
     * @inheritDoc
    */
    public function cache(CompiledTemplateInterface $compiledTemplate): CachedTemplateInterface
    {
        try {

            $template  = $compiledTemplate->getTemplate();
            $cacheKey  = $template->getCacheKey();
            $cacheFile = new File($this->fileLocator->locate($cacheKey .'.php'));

            if(!$cacheFile->dump($compiledTemplate->getCompiled())) {
                throw new TemplateCacheException("Something went wrong during caching template.");
            }

            $template  = new CachedTemplate($cacheFile->getPath(), $template->getParameters());
            $template->withCachePath($this->fileLocator->getRoot());
            return $template;

        } catch (\Throwable $e) {
            throw new TemplateCacheException($e->getMessage());
        }
    }
}
