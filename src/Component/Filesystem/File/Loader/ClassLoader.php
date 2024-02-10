<?php
declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Loader;


use Laventure\Contract\Loader\LoaderInterface;

/**
 * ClassLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\File\Loader
*/
class ClassLoader implements LoaderInterface
{

    /**
     * @var string
    */
    protected string $basePath;



    /**
     * @var string
    */
    protected string $classname;




    /**
     * @param string $classname
    */
    public function __construct(string $classname)
    {
        $this->classname = $classname;
    }




    /**
     * @param string $path
     * @return $this
    */
    public function basePath(string $path): static
    {
        $this->basePath  = rtrim($path, DIRECTORY_SEPARATOR);

        return $this;
    }




    /**
     * @return array
    */
    public function getFragments(): array
    {
       return explode("\\", $this->classname);
    }




    /**
     * @return string|null
    */
    public function getBasePath(): ?string
    {
        $fragments = $this->getFragments();

        return $fragments[0] ?? null;
    }




    /**
     * @inheritDoc
    */
    public function load(): mixed
    {
        $loader = new FileLoader(sprintf('%s.php', $this->normalizePath()));

        return $loader->load();
    }




    /**
     * @return string
    */
    private function normalizePath(): string
    {
        return str_replace([
            $this->getBasePath(),
            '\\'
        ], [
            $this->basePath,
            DIRECTORY_SEPARATOR
        ], $this->classname);
    }
}