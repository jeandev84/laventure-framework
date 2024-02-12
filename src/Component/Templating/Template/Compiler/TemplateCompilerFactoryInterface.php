<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

/**
 * TemplateCompilerFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler
*/
interface TemplateCompilerFactoryInterface
{
    /**
     * @param CompilerInterface[] $compilers
     *
     * @return TemplateCompilerInterface
    */
    public function create(array $compilers = []): TemplateCompilerInterface;
}
