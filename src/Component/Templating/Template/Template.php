<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template;

use Laventure\Component\Templating\Template\Exception\NotFoundTemplateException;

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
     * @var array
    */
    protected array $parameters = [];



    public function __construct(string $path, array $parameters = [])
    {
        $this->path       = $path;
        $this->parameters = $parameters;
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
        return md5($this->path);
    }
}
