<?php

declare(strict_types=1);

namespace Laventure\Foundation\Templating\Template\Factory;

use Laventure\Component\Filesystem\File\Locator\FileLocator;
use Laventure\Component\Filesystem\File\Locator\FileLocatorInterface;
use Laventure\Component\Templating\Template\Contract\TemplateInterface;
use Laventure\Component\Templating\Template\Factory\TemplateFactoryInterface;
use Laventure\Component\Templating\Template\Template;

/**
 * TemplateFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Templating\Template\Factory
 */
class TemplateFactory implements TemplateFactoryInterface
{
    /**
     * @var FileLocator
    */
    protected FileLocator $fileLocator;


    /**
     * @param string $viewPath
    */
    public function __construct(string $viewPath)
    {
        $this->fileLocator = new FileLocator($viewPath);
    }



    /**
     * @inheritDoc
    */
    public function createTemplate(string $path, array $parameters = []): TemplateInterface
    {
        return new Template($this->fileLocator->locate($path), $parameters);
    }
}
