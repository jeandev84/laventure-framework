<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;
use Laventure\Component\Templating\Template\Traits\HasTemplateTrait;

/**
 * CompiledTemplate
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler
 */
class CompiledTemplate implements CompiledTemplateInterface
{
    use HasTemplateTrait;

    protected string $compiled;



    /**
     * @param TemplateInterface $template
     * @param string $compiled
    */
    public function __construct(TemplateInterface $template, string $compiled)
    {
        $this->withTemplate($template)
             ->withCompiled($compiled);
    }




    /**
     * @inheritDoc
    */
    public function getCompiled(): string
    {
        return $this->compiled;
    }




    /**
     * @inheritDoc
    */
    public function withCompiled(string $compiled): static
    {
        $this->compiled = $compiled;

        return $this;
    }
}
