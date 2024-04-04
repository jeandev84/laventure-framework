<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Cache;

use Laventure\Component\Templating\Template\Contract\HasTemplateInterface;
use Laventure\Component\Templating\Template\Contract\TemplateInterface;

/**
 * CachedTemplateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Cache
 */
interface CachedTemplateInterface extends TemplateInterface
{
    /**
     * @param string $cachePath
     * @return $this
    */
    public function withCachePath(string $cachePath): static;



    /**
     * @return string
    */
    public function getCachePath(): string;
}
