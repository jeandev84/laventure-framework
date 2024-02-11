<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Cache;

use Laventure\Component\Templating\Template\TemplateInterface;

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
     * @param string $key
     * @param string|TemplateInterface $template
     * @return string
    */
    public function cache(string $key, string|TemplateInterface $template): string;
}
