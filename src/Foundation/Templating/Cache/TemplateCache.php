<?php

declare(strict_types=1);

namespace Laventure\Foundation\Templating\Cache;

use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Templating\Template\Cache\Exception\TemplateCacheException;
use Laventure\Component\Templating\Template\Cache\TemplateCacheInterface;
use Laventure\Component\Templating\Template\TemplateInterface;

/**
 * TemplateCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Templating\Cache
 */
class TemplateCache implements TemplateCacheInterface
{
    /**
     * @param Filesystem $filesystem
     */
    public function __construct(protected Filesystem $filesystem)
    {
    }



    /**
     * @param string $key
     *
     * @return string
    */
    public function cachePath(string $key): string
    {
        return $this->filesystem->locate(md5($key) .'.php');
    }



    /**
     * @inheritDoc
     */
    public function cache(string $key, string|TemplateInterface $template): string
    {
        try {
            return $this->filesystem->dump(md5($key) .'.php', strval($template));
        } catch (\Throwable $e) {
            throw new TemplateCacheException($e->getMessage());
        }
    }
}
