<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Renderer;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;
use Laventure\Component\Templating\Template\Engine\TemplateEngineInterface;

/**
 * Renderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Renderer
*/
class Renderer implements RendererInterface
{
    /**
     * @var TemplateEngineInterface
    */
    protected TemplateEngineInterface $engine;



    /**
     * @var array
    */
    protected array $data = [];




    /**
     * @var array
    */
    protected array $paths = [];




    /**
     * @var array
    */
    protected array $extensions = [];






    /**
     * @param TemplateEngineInterface $engine
    */
    public function __construct(TemplateEngineInterface $engine)
    {
        $this->engine = $engine;
    }






    /**
     * @inheritDoc
    */
    public function addGlobals(array $data): static
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addPath(string $id, string $path): static
    {
        $this->paths[$id] = $path;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function addExtensions(array $extensions): static
    {
        foreach ($extensions as $extension) {
            $this->addExtension($extension);
        }

        return $this;
    }






    /**
     * @param object $extension
     *
     * @return $this
    */
    public function addExtension(object $extension): static
    {
        $this->extensions[] = $extension;

        return $this;
    }






    /**
     * @param string $template
     *
     * @param array $data
     *
     * @return TemplateInterface
    */
    public function createTemplate(string $template, array $data = []): TemplateInterface
    {
        $templateFactory = $this->engine->config()->getTemplateFactory();

        return $templateFactory->createTemplate($template, array_merge($this->data, $data));
    }






    /**
     * @inheritDoc
    */
    public function render(string $path, array $data = []): string
    {
        return $this->engine->transform($this->createTemplate($path, $data));
    }





    /**
     * @inheritDoc
    */
    public function getGlobals(): array
    {
        return $this->data;
    }




    /**
     * @inheritDoc
     */
    public function getExtensions(): array
    {
        return $this->extensions;
    }





    /**
     * @inheritDoc
    */
    public function getPaths(): array
    {
        return $this->paths;
    }





    /**
     * @return TemplateEngineInterface
    */
    public function getEngine(): TemplateEngineInterface
    {
        return $this->engine;
    }
}
