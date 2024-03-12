<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator;


/**
 * ClassGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator
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