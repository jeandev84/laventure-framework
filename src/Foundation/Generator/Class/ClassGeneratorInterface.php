<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Class;

use Laventure\Component\Filesystem\File\Generator\FileGeneratorInterface;

/**
 * ClassGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Class
 */
interface ClassGeneratorInterface extends FileGeneratorInterface
{
    /**
     * Map classname
     *
     * @param string $classname
     * @return $this
    */
    public function withClassName(string $classname): static;








    /**
     *  Returns class namespace
     *
     *  (e.g, App\Http\Api\Books)
     *
     * @return string
     */
    public function getNamespace(): string;





    /**
     * Returns class name
     *
     * @return string
     */
    public function getClassName(): string;






    /**
     * Returns full class name
     *
     * @return string
    */
    public function getClassFullName(): string;






    /**
     * @return array
     */
    public function getMethods(): array;








    /**
     * Returns class module
     * e.g "App\Http\Api\Books\BookController
     * will be returned "Api\Books"
     *
     * e.g "App\Http\Admin\UserController
     * will be returned "Admin"
     *
     * @return string
    */
    public function getModule(): string;








    /**
     * Determine if class in module
     *
     * @return bool
    */
    public function hasModule(): bool;







    /**
     * Generate class methods stub
     *
     * @return string
    */
    public function generateStubMethods(): string;
}
