<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Controller\Api;

use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Foundation\Generator\Controller\ControllerGenerator;
use Laventure\Foundation\Generator\Controller\ResourceControllerGenerator;

/**
 * ApiResourceControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Controller\Api
*/
class ApiResourceControllerGenerator extends ResourceControllerGenerator
{
       /**
        * @var ApiResource|null
       */
       protected ?ApiResource $apiResource = null;




       /**
        * @param string $controller
        * @return $this
       */
       public function withApiController(string $controller): static
       {
           $this->apiResource = new ApiResource('', $controller);

           return $this->withResource($this->apiResource);
       }
}