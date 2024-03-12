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
abstract class ClassGenerator extends FileGenerator
{

     /**
      * Returns class name
      *
      * @return string
     */
     abstract public function getClassName(): string;
}