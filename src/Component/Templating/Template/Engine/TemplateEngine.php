<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Engine;

use Laventure\Component\Templating\Template\Cache\CachedTemplateInterface;
use Laventure\Component\Templating\Template\Compiler\CompiledTemplateInterface;
use Laventure\Component\Templating\Template\Contract\TemplateInterface;
use Laventure\Component\Templating\Template\Engine\Config\TemplateEngineConfigInterface;
use Laventure\Component\Templating\Template\Template;

/**
 * TemplateEngine
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine
*/
class TemplateEngine implements TemplateEngineInterface
{
    /**
     * @param TemplateEngineConfigInterface $config
    */
    public function __construct(protected TemplateEngineConfigInterface $config)
    {
    }



    /**
     * @inheritDoc
    */
    public function config(): TemplateEngineConfigInterface
    {
        return $this->config;
    }




    /**
     * @inheritDoc
    */
    public function transform(TemplateInterface $template): string
    {
        $compiledTemplate = $this->compile($template);
        $template         = $this->cache($compiledTemplate);
        return $this->config->getLoader()->withTemplate($template)->load();
    }




    /**
     * @param TemplateInterface $template
     * @return CompiledTemplateInterface
    */
    public function compile(TemplateInterface $template): CompiledTemplateInterface
    {
        return $this->config->getCompiler()->compile($template);
    }




    /**
     * @param CompiledTemplateInterface $template
     * @return CachedTemplateInterface
    */
    public function cache(CompiledTemplateInterface $template): CachedTemplateInterface
    {
        return $this->config->getCache()->cache($template);
    }
}
