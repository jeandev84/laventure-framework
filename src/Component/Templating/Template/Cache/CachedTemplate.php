<?php
declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Cache;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;
use Laventure\Component\Templating\Template\Traits\HasTemplateTrait;

/**
 * CachedTemplate
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Cache
*/
class CachedTemplate implements CachedTemplateInterface
{
      use HasTemplateTrait;


      /**
       * @var string
      */
      protected string $cachePath;


      /**
       * @param TemplateInterface $template
       * @param string $cachePath
      */
      public function __construct(TemplateInterface $template, string $cachePath)
      {
          $this->withTemplate($template)
               ->withCachePath($cachePath);
      }


      /**
       * @inheritDoc
      */
      public function withCachePath(string $cachePath): static
      {
           $this->cachePath = $cachePath;

           return $this;
      }



      /**
       * @inheritDoc
      */
      public function getCachePath(): string
      {
           return $this->cachePath;
      }
}