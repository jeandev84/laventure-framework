<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Locator;

/**
 * FileLocator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Locator
*/
class FileLocator implements FileLocatorInterface
{
    /**
     * base path
     *
     * @var string
    */
    protected string $root;




    /**
     * @param string $root
    */
    public function __construct(string $root)
    {
        $this->setRoot($root);
    }



    /**
     * @inheritDoc
    */
    public function setRoot(string $root): static
    {
        $this->root = $this->normalizeBasePath($root);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function locate(string $file): string
    {
        return join(DIRECTORY_SEPARATOR, [$this->root, $this->normalizePath($file)]);
    }





    /**
     * @inheritDoc
    */
    public function locateResources(string $pattern): array
    {
        return glob($this->locate($pattern)) ?: [];
    }





    /**
     * @inheritDoc
    */
    public function getRoot(): string
    {
        return $this->root;
    }



    /**
     * @param string $path
     * @return string
     */
    private function normalizePath(string $path): string
    {
        return str_replace(["\\", "/"], DIRECTORY_SEPARATOR, trim($path, '\\/'));
    }




    /**
     * @param string $root
     * @return string
     */
    private function normalizeBasePath(string $root): string
    {
        return rtrim($root, DIRECTORY_SEPARATOR);
    }
}
