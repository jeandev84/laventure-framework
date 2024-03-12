<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Info;

use Laventure\Component\Routing\Route\Resource\Resource;

/**
 * ResourceInfo
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource\Info
 */
class ResourceInfo implements ResourceInfoInterface
{
    /**
     * @param Resource $resource
    */
    public function __construct(
        protected Resource $resource
    ) {
    }




    /**
     * @inheritDoc
    */
    public function getMethods(): array
    {

    }
}
