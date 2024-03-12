<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Web;

use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\WebResource;
use Laventure\Foundation\Generator\Resource\ResourceControllerGenerator;

/**
 * WebResourceControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource\Web
*/
class WebResourceGenerator extends ResourceControllerGenerator
{

        /**
         * @param $entity
         * @return $this
        */
        public function webResource($entity): static
        {
             dd('entity: '. $entity, 'from: '. get_called_class());

            return $this->withResource(new WebResource('books', $entity));
        }
}