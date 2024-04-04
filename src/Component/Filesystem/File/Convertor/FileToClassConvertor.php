<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Convertor;

/**
 * FileToClassConvertor
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\File\Convertor
 */
class FileToClassConvertor implements FileToClassConvertorInterface
{
    /**
     * @var array
    */
    protected array $files = [];


    /**
     * @param string $basePath
     * @param string $baseDirectory
     * @param string $baseNamespace
     * @param array $files
    */
    public function __construct(
        protected string $basePath,
        protected string $baseDirectory,
        protected string $baseNamespace,
        array            $files = []
    ) {
        $this->withFiles($files);
    }





    /**
     * @inheritDoc
    */
    public function getBaseDirectory(): string
    {
        return $this->baseDirectory;
    }




    /**
     * @inheritDoc
    */
    public function getBaseNamespace(): string
    {
        return $this->baseNamespace;
    }






    /**
     * @inheritDoc
    */
    public function getBasePath(): string
    {
        return $this->basePath;
    }




    /**
     * @inheritDoc
    */
    public function withFiles(array $files): static
    {
        $this->files = $files;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getFiles(): array
    {
        return $this->files;
    }



    /**
     * @inheritDoc
    */
    public function convert(): array
    {
        $classes = [];

        foreach ($this->files as $file) {
            $classname = $this->convertPathToClass($file);
            if (!class_exists($classname)) {
                continue;
            }
            $classes[] = $classname;
        }

        return $classes;
    }





    /**
     * @param string $path
     * @return string
    */
    private function convertPathToClass(string $path): string
    {
        $search    = [$this->baseDirectory, '/'];
        $replaces  = [$this->baseNamespace, "\\"];
        $path      = str_replace($this->basePath, '', $path);
        $path      = ltrim($path, '/');
        $info      = pathinfo($path);
        $dirname   = str_replace($search, $replaces, $info['dirname']);
        $filename  = $info['filename'];
        return     "$dirname\\$filename";
    }
}
