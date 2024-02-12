<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Cache;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;

/**
 * TemplateCacheInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Cache
*/
interface TemplateCacheInterface
{
    /**
     * Cache template
     *
     * @param TemplateInterface $template
     * @return CachedTemplateInterface
    */
    public function cache(TemplateInterface $template): CachedTemplateInterface;
}
