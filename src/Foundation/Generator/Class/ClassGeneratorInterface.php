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
     * Returns class namespace
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
     * @return string
    */
    public function generateStubMethods(): string;





    /**
     * Returns namespace with module
     * (e.g, if exists module Api\Books namespace will be App\Http\Api\Books)
     * (e.g, if exists module Api namespace wille be App\Http\Api)
     *
     * @return string
    */
    public function getNamespaceWithModule(): string;
}