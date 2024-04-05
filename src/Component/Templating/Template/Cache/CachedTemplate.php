<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Cache;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;
use Laventure\Component\Templating\Template\Template;
use Laventure\Component\Templating\Template\Traits\HasTemplateTrait;

/**
 * CachedTemplate
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Caching
*/
class CachedTemplate extends Template implements CachedTemplateInterface
{
    /**
     * @var string
    */
    protected string $cachePath;


    /**
     * @param string $path
     * @param array $parameters
    */
    public function __construct(
        string $path,
        array $parameters = [],
    ) {
        parent::__construct($path, $parameters);
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
