<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

use Laventure\Component\Templating\Template\Factory\TemplateFactoryInterface;
use Laventure\Component\Templating\Template\Loader\TemplateLoaderInterface;

/**
 * TemplateCompilerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler
*/
class TemplateCompilerFactory implements TemplateCompilerFactoryInterface
{
    /**
     * @param TemplateLoaderInterface $loader
     * @param TemplateFactoryInterface $factory
    */
    public function __construct(
        protected TemplateLoaderInterface $loader,
        protected TemplateFactoryInterface $factory
    ) {

    }




    /**
     * @inheritDoc
    */
    public function create(array $compilers = []): TemplateCompilerInterface
    {
        return new TemplateCompiler(
            $this->loader,
            $this->factory
        );
    }
}
