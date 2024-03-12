<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Api;

use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Foundation\Generator\Resource\ResourceControllerGenerator;

/**
 * ApiResourceControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource\Api
*/
class ApiResourceGenerator extends ResourceControllerGenerator
{

      /**
       * @inheritDoc
      */
      public function getResource(): Resource
      {
         return new ApiResource('api.books', $this->getClassName());
      }
}