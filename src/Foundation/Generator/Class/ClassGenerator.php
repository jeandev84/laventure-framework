<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Class;


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
    public function withClass(string $classname): static
    {
        $this->classNames  = explode("/", $classname);

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
        $module = str_replace(
            $this->getClassName(),
    '',
            $this->getParsedClassName()
        );

        return trim($module, "\\/");
    }





    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        return end($this->classNames);
    }





    /**
     * @inheritDoc
    */
    public function getTargetPath(): string
    {
        if ($module = $this->getModule()) {
            return $this->generatePathPHP([
                $this->getBaseDir(),
                $module,
                $this->getClassName()
            ]);
        }

        return $this->generatePathPHP([
            $this->getBaseDir(),
            $this->getClassName()
        ]);
    }






    /**
     * @inheritDoc
    */
    public function generateStubMethods(): string
    {
        if (empty($this->methods)) {
            return '';
        }

        return $this->processGenerateMethodsStub();
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

        return $module ? "$module\\$namespace" : $namespace;
    }





    /**
     * @return string
    */
    public function getParsedClassName(): string
    {
        return join('/', $this->classNames);
    }





    /**
     * @return string
    */
    protected function processGenerateMethodsStub(): string
    {
        return '';
    }
}