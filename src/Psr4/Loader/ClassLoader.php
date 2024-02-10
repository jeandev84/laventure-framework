<?php
declare(strict_types=1);

namespace Laventure\Psr4\Loader;


use Laventure\Contract\Loader\LoaderInterface;


/**
 * ClassLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Psr4\Loader
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
    public function getPrefix(): ?string
    {
        $fragments = $this->getFragments();

        return $fragments[0] ?? null;
    }




    /**
     * @inheritDoc
    */
    public function load(): bool
    {
        $path = sprintf('%s.php', $this->normalizePath());

        if (!file_exists($path)) {
            return false;
        }

        require_once $path;
        return true;
    }





    /**
     * @return string
    */
    private function normalizePath(): string
    {
        return str_replace([
            $this->getPrefix(),
            '\\'
        ], [
            $this->basePath,
            DIRECTORY_SEPARATOR
        ], $this->classname);
    }
}