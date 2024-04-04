<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Transformer;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;

/**
 * TemplateTransformerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Transformer
*/
interface TemplateTransformerInterface
{
    /**
     * Processing transform template in HTML code
     * and returns content
     *
     * @param TemplateInterface $template
     *
     * @return string
    */
    public function transform(TemplateInterface $template): string;
}
