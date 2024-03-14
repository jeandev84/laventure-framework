<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Engine\Config;

use Laventure\Component\Templating\Template\Cache\CompiledTemplateCacheInterface;
use Laventure\Component\Templating\Template\Cache\NullCompiledTemplateCache;
use Laventure\Component\Templating\Template\Compiler\TemplateCompiler;
use Laventure\Component\Templating\Template\Compiler\TemplateCompilerInterface;
use Laventure\Component\Templating\Template\Factory\NullTemplateFactory;
use Laventure\Component\Templating\Template\Factory\TemplateFactoryInterface;
use Laventure\Component\Templating\Template\Loader\NullTemplateLoader;
use Laventure\Component\Templating\Template\Loader\TemplateLoaderInterface;
use Laventure\Component\Templating\Template\Reader\NullTemplateReader;
use Laventure\Component\Templating\Template\Reader\TemplateReaderInterface;

/**
 * TemplateConfig
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine\Common
*/
class TemplateEngineConfig implements TemplateEngineConfigInterface
{
    /**
     * @var TemplateFactoryInterface
    */
    protected TemplateFactoryInterface $templateFactory;



    /**
     * @var TemplateLoaderInterface
    */
    protected TemplateLoaderInterface $loader;



    /**
     * @var TemplateReaderInterface
    */
    protected TemplateReaderInterface $reader;



    /**
     * @var CompiledTemplateCacheInterface
    */
    protected CompiledTemplateCacheInterface $cache;



    /**
     * @var TemplateCompilerInterface|null
    */
    protected ?TemplateCompilerInterface $compiler = null;




    public function __construct()
    {
        $this->loader          = new NullTemplateLoader();
        $this->reader          = new NullTemplateReader();
        $this->cache           = new NullCompiledTemplateCache();
        $this->templateFactory = new NullTemplateFactory();
    }




    /**
     * @inheritDoc
    */
    public function withLoader(TemplateLoaderInterface $loader): static
    {
        $this->loader = $loader;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getLoader(): TemplateLoaderInterface
    {
        return $this->loader;
    }




    /**
     * @inheritDoc
    */
    public function withTemplateFactory(TemplateFactoryInterface $factory): static
    {
        $this->templateFactory = $factory;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getTemplateFactory(): TemplateFactoryInterface
    {
        return $this->templateFactory;
    }




    /**
     * @inheritDoc
    */
    public function withCache(CompiledTemplateCacheInterface $cache): static
    {
        $this->cache = $cache;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getCache(): CompiledTemplateCacheInterface
    {
        return $this->cache;
    }




    /**
     * @inheritDoc
    */
    public function withReader(TemplateReaderInterface $reader): static
    {
        $this->reader = $reader;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getReader(): TemplateReaderInterface
    {
        return $this->reader;
    }




    /**
     * @inheritDoc
    */
    public function withCompiler(TemplateCompilerInterface $compiler): static
    {
        $this->compiler = $compiler;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getCompiler(): TemplateCompilerInterface
    {
        if (! $this->compiler) {
            $this->compiler = new TemplateCompiler(
                $this->reader,
                $this->templateFactory
            );
        }

        return $this->compiler;
    }
}
