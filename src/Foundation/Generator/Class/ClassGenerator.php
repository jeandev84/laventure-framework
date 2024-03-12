<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Class;


use Laventure\Component\Filesystem\File\File;
use Laventure\Foundation\Generator\Class\Exception\ClassGeneratorException;
use Laventure\Foundation\Generator\File\FileGenerator;

/**
 * ClassGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Common
*/
abstract class ClassGenerator extends FileGenerator implements ClassGeneratorInterface
{
    /**
     * @var array
    */
    protected array $classNames = [];



    /**
     * @var array
    */
    protected array $methods = [];





    /**
     * @param string $classname
     * @return $this
    */
    public function withClassName(string $classname): static
    {
        $this->classNames = $this->convertPathToArray($classname);

        return $this;
    }






    /**
     * @param array $methods
     * @return $this
    */
    public function withMethods(array $methods): static
    {
        $this->methods = array_merge($this->methods, $methods);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {
        return $this->methods;
    }







    /**
     * @inheritDoc
    */
    public function getModule(): string
    {
        $module = str_replace($this->getClassName(), '',
            $this->getParsedClassName()
        );

        return trim($module, "\\/");
    }






    /**
     * @inheritDoc
    */
    public function hasModule(): bool
    {
        return count($this->classNames) > 1;
    }






    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        return $this->getLastFromArray($this->classNames);
    }





    /**
     * @inheritDoc
    */
    public function getTargetPath(): string
    {
        if ($this->hasModule()) {
            return $this->generatePathPHPWithModule();
        }

        return $this->generatePathPHPWithoutModule();
    }





    /**
     * @inheritDoc
     */
    public function getContent(): string
    {
        return $this->generateStub([
            "DummyNamespace" => $this->getNamespace(),
            "DummyClassName" => $this->getClassName(),
            "DummyActions"   => $this->generateStubMethods()
        ]);
    }







    /**
     * @inheritDoc
    */
    public function generateStubMethods(): string
    {
        if (empty($this->methods)) { return ''; }

        $methodStubs = [];

        foreach ($this->methods as $method) {
            $methodStubs[] = $this->generateStubForMethod($method);
        }

        return join(array_filter($methodStubs));
    }






    /**
     *  Returns namespace with module
     *  (e.g, if exists module Api\Books namespace will be App\Http\Api\Books)
     *  (e.g, if exists module Api namespace wille be App\Http\Api)
     *
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        $namespace = $this->getBaseNamespace();
        $module    = $this->getModule();

        return $module ? "$namespace\\$module" : $namespace;
    }





    /**
     * @return string
    */
    public function getParsedClassName(): string
    {
        return join('/', $this->classNames);
    }




    /**
     * @param string $method
     * @return string
     * @throws ClassGeneratorException
    */
    public function generateStubForMethod(string $method): string
    {
        $methodStub                  = $this->getMethodStubFile();
        $patterns["DummyClassName"]  = $this->getClassName();
        $patterns["DummyActionName"] = strtolower($method);

        return $methodStub->stub($patterns);
    }





    /**
     * @return File
     * @throws ClassGeneratorException
    */
    public function getMethodStubFile(): File
    {
        return $this->file($this->getMethodStubPath());
    }






    /**
     * @return string
    */
    protected function generatePathPHPWithoutModule(): string
    {
        return $this->generatePathPHP([
            $this->getBaseDir(),
            $this->getClassName()
        ]);
    }





    /**
     * @return string
    */
    protected function generatePathPHPWithModule(): string
    {
        return $this->generatePathPHP([
            $this->getBaseDir(),
            $this->getModule(),
            $this->getClassName()
        ]);
    }





    /**
     * @return string
     * @throws ClassGeneratorException
    */
    public function getMethodStubPath(): string
    {
         throw new ClassGeneratorException("You needs implements ". __METHOD__);
    }
}