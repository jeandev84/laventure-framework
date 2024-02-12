<?php
declare(strict_types=1);

namespace Laventure\Component\Templating\Template;


/**
 * HasTemplateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template
 */
interface HasTemplateInterface
{

     /**
      * Set template
      *
      * @param TemplateInterface $template
      *
      * @return $this
     */
     public function withTemplate(TemplateInterface $template): static;




     /**
      * Returns template
      *
      * @return TemplateInterface
     */
     public function getTemplate(): TemplateInterface;
}