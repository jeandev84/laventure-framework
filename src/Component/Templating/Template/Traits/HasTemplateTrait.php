<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Traits;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;

/**
 * HasTemplateTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Traits
*/
trait HasTemplateTrait
{
    /**
     * @var TemplateInterface
    */
    protected TemplateInterface $template;



    /**
     * @param TemplateInterface $template
     * @return $this
    */
    public function withTemplate(TemplateInterface $template): static
    {
        $this->template = $template;

        return $this;
    }





    /**
     * Returns template
     *
     * @return TemplateInterface
    */
    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }
}
