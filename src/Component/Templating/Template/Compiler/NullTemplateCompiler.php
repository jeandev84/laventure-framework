<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;

/**
 * NullTemplateCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler
 */
class NullTemplateCompiler implements TemplateCompilerInterface
{
    /**
     * @inheritDoc
    */
    public function compile(TemplateInterface $template): CompiledTemplateInterface
    {
        return new CompiledTemplate($template, '');
    }


    /**
     * @inheritDoc
    */
    public function getCompilers(): array
    {
        return [];
    }
}
