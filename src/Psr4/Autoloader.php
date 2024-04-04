<?php

declare(strict_types=1);

namespace Laventure\Psr4;

/**
 * Autoloader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Psr4
 */
class Autoloader
{
    /**
     * @var string
    */
    private string $loaderFile = 'laventure.json';


    /**
     * @var string
     */
    protected string $root;



    /**
     * @var array
     */
    protected array $prefixes = [];



    /**
     * @param string $root
     */
    public function __construct(string $root)
    {
        $this->root = realpath(rtrim($root, DIRECTORY_SEPARATOR));
    }





    /**
     * @param string $namespace
     *
     * @param string $basePath
     *
     * @return $this
     */
    public function addPrefix(string $namespace, string $basePath): static
    {
        $this->prefixes[trim($namespace, '\\')] = $this->path($basePath);

        return $this;
    }





    /**
     * @return array
     */
    public function getPrefixes(): array
    {
        return $this->prefixes;
    }




    /**
     * @param array $namespaces
     *
     * @return $this
     */
    public function addPrefixes(array $namespaces): static
    {
        foreach ($namespaces as $prefix => $basePath) {
            $this->addPrefix($prefix, $basePath);
        }

        return $this;
    }




    /**
     * @param string $prefix
     *
     * @return bool
     */
    public function prefixed(string $prefix): bool
    {
        return array_key_exists($prefix, $this->prefixes);
    }




    /**
     * Register classes
     */
    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }





    /**
     * Unregister classes
     */
    public function unregister(): void
    {
        spl_autoload_unregister([$this, 'loadClass']);
    }





    /**
     * Autoload from file
     *
     * @param string $root
     *
     * @return void
     */
    public static function load(string $root): void
    {
        $autoloader = new self($root);
        $prefixes   = $autoloader->loadParams()['psr-4'] ?? [];
        $autoloader->addPrefixes($prefixes);
        $autoloader->register();
    }






    /**
     * @param string $class
     *
     * @return bool
     */
    public function loadClass(string $class): bool
    {
        $fragments = explode('\\', $class);

        $prefix = array_shift($fragments);

        if (! $this->prefixed($prefix)) {
            return false;
        }

        array_unshift($fragments, $this->prefixes[$prefix]);

        $path = $this->loadClassPath($fragments);

        if (! file_exists($path)) {
            return false;
        }

        require_once $path;
        return true;
    }





    /**
     * @param string $path
     *
     * @return string
     */
    private function normalizePath(string $path): string
    {
        $trimmed = trim($path, '\\/');

        return str_replace(["\\", "/"], DIRECTORY_SEPARATOR, $trimmed);
    }




    /**
     * @param string $path
     *
     * @return string
     */
    private function path(string $path): string
    {
        return  join(DIRECTORY_SEPARATOR, [$this->root, $this->normalizePath($path)]);
    }






    /**
     * @param array $fragments
     *
     * @return string
    */
    private function loadClassPath(array $fragments): string
    {
        return join(DIRECTORY_SEPARATOR, $fragments) . '.php';
    }





    /**
     * @return array
     */
    private function loadParams(): array
    {
        $path = $this->path($this->loaderFile);

        if (! file_exists($path)) {
            return [];
        }

        return json_decode(file_get_contents($path), true);
    }
}
