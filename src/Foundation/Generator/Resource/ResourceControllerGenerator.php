<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource;


use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Foundation\Generator\Controller\ControllerGenerator;

/**
 * ResourceControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource
*/
abstract class ResourceControllerGenerator extends ControllerGenerator
{

      /**
       * @var string
      */
      protected string $resource;


//    /**
//     * @param Resource $resource
//     * @return $this
//    */
//    public function withResource(Resource $resource): static
//    {
//        return $this->withController(
//            $resource->getController(),
//            $resource->getInfo()->getMethods()
//        );
//    }





      /**
       * @param string $resource
       * @return $this
      */
      public function withResource(string $resource): static
      {
           $this->resource = $resource;

           return $this->withClassName($resource);
      }






//    /**
//     * @param string $entity
//     * @return string
//    */
//    protected function generateControllerName(string $entity): string
//    {
//        $entity = str_replace(['/'], ["\\"], $entity);
//
//        return sprintf('%sController', strtoupper($entity));
//    }





       /**
        * @return bool
       */
       public function generateResource(): bool
       {

           dd($this->getResource());


           return $this->generate();
       }



       /**
        * @return Resource
       */
       abstract public function getResource(): Resource;
}