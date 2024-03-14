<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Engine\Config;

use Laventure\Component\Templating\Template\Cache\CompiledTemplateCacheInterface;
use Laventure\Component\Templating\Template\Compiler\TemplateCompilerInterface;
use Laventure\Component\Templating\Template\Factory\TemplateFactoryInterface;
use Laventure\Component\Templating\Template\Loader\TemplateLoaderInterface;
use Laventure\Component\Templating\Template\Reader\TemplateReaderInterface;

/**
 * TemplateEngineConfigInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine\Common
*/
interface TemplateEngineConfigInterface
{
    /**
     * @param TemplateLoaderInterface $loader
     * @return $this
    */
    public function withLoader(TemplateLoaderInterface $loader): static;




    /**
     * @return TemplateLoaderInterface
    */
    public function getLoader(): TemplateLoaderInterface;




    /**
     * @param TemplateReaderInterface $reader
     * @return $this
    */
    public function withReader(TemplateReaderInterface $reader): static;




    /**
     * @return TemplateReaderInterface
    */
    public function getReader(): TemplateReaderInterface;





    /**
     * @param TemplateCompilerInterface $compiler
     * @return $this
    */
    public function withCompiler(TemplateCompilerInterface $compiler): static;



    /**
     * Returns template compiler
     *
     * @return TemplateCompilerInterface
    */
    public function getCompiler(): TemplateCompilerInterface;




    /**
     * @param TemplateFactoryInterface $factory
     * @return $this
    */
    public function withTemplateFactory(TemplateFactoryInterface $factory): static;




    /**
     * @return TemplateFactoryInterface
    */
    public function getTemplateFactory(): TemplateFactoryInterface;





    /**
     * @param CompiledTemplateCacheInterface $cache
     *
     * @return $this
    */
    public function withCache(CompiledTemplateCacheInterface $cache): static;





    /**
     * @return mixed
    */
    public function getCache(): CompiledTemplateCacheInterface;
}
