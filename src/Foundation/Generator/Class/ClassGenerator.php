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
     * @var string
    */
    protected string $parsedName = '';


    /**
     * @var string
    */
    protected string $module = '';




    /**
     * @var string
    */
    protected string $suffix = '';



    /**
     * @var array
    */
    protected array $classNames = [];




    /**
     * @var array
    */
    protected array $methods = [];





    /**
     * @inheritDoc
    */
    public function withClassName(string $classname): static
    {
        $classNames       = $this->convertPathToArray($classname);
        $this->classNames = $classNames;
        $this->parsedName = $classname;
        array_pop($classNames);
        $this->module     = join("\\", $classNames);

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
     * @param string $suffix
     * @return $this
    */
    public function withClassSuffix(string $suffix): static
    {
        $this->suffix = $suffix;

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
        return $this->module;
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
        $classname = $this->getLastElementOfArray($this->classNames);

        if ($this->suffix) {
            $classname = sprintf('%s%s', $classname, $this->suffix);
        }

        return $classname;
    }



    /**
     * @inheritDoc
    */
    public function generateFullClassName(string $suffix = ''): string
    {
        $namespace = $this->getNamespace();
        $className = $this->getClassName();

        if ($module = $this->getModule()) {
            $className = "$module\\$className";
        }

        return sprintf('%s\\%s%s', $namespace, $className, $suffix);
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
     * @throws ClassGeneratorException
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
     * @throws ClassGeneratorException
    */
    public function generateStubMethods(): string
    {
        if (empty($this->methods)) {
            return '';
        }

        $methodStubs = [];

        foreach ($this->methods as $method) {
            $methodStubs[] = $this->generateDefaultStubForMethod($method);
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
     * Returns entity full name
     *
     * @return string
    */
    public function getEntityFullName(): string
    {
        $classname = $this->getClassName();

        return sprintf("%s\\%s", $this->getNamespace(), $classname);
    }




    /**
     * @return string
     * @throws ClassGeneratorException
    */
    public function getParsedClassName(): string
    {
        if (!$this->parsedName) {
            throw new ClassGeneratorException(
                "No classname parsed inside ". get_called_class()
            );
        }

        return $this->parsedName;
    }






    /**
     * @param string $method
     * @return string
     * @throws ClassGeneratorException
    */
    public function generateDefaultStubForMethod(string $method): string
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
