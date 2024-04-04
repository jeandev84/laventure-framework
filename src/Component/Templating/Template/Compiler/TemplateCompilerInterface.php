<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;

/**
 * TemplateCompilerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler
*/
interface TemplateCompilerInterface
{
    /**
     * Compile template
     *
     * @param TemplateInterface $template
     *
     * @return CompiledTemplateInterface
    */
    public function compile(TemplateInterface $template): CompiledTemplateInterface;





    /**
     * Returns compilers
     *
     * @return CompilerInterface[]
    */
    public function getCompilers(): array;
}
