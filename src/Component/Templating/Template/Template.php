<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;

/**
 * @inheritdoc
*/
class Template implements TemplateInterface
{
    /**
     * @var string
    */
    protected string $path;


    /**
     * @var string
    */
    protected string $cacheKey;


    /**
     * @var array
    */
    protected array $parameters = [];


    /**
     * @param string $path
     * @param array $parameters
    */
    public function __construct(string $path, array $parameters = [])
    {
        $this->path       = $path;
        $this->parameters = $parameters;
        $this->cacheKey   = md5($path);
    }



    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }



    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }




    /**
     * @inheritDoc
    */
    public function getCacheKey(): string
    {
        return $this->cacheKey;
    }



    /**
     * @inheritDoc
    */
    public function withCacheKey(string $cacheKey): static
    {
        $this->cacheKey = $cacheKey;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        extract($this->parameters);
        ob_start();
        require $this->path;
        return ob_get_clean();
    }
}
