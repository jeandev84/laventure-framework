<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource;


use Laventure\Foundation\Generator\Class\ClassGeneratorInterface;


/**
 * ResourceGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource
*/
interface ResourceGeneratorInterface extends ClassGeneratorInterface
{


      /**
       * @param $resource
       * @return $this
      */
      public function withResource($resource): static;






      /**
       * Generate controller
       *
       * @return bool
      */
      public function generateController(): bool;




      /**
       * Generate Entity
       *
       * @return bool
      */
      public function generateEntity(): bool;
}