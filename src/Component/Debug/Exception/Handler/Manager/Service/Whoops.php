<?php

declare(strict_types=1);

namespace Laventure\Component\Debug\Exception\Handler\Manager\Service;

use Laventure\Component\Debug\Exception\Handler\Manager\HandlerManager;
use Laventure\Component\Debug\Exception\Handler\Register\HandlerRegistry;
use Laventure\Component\Debug\Exception\Handler\Register\HandlerRegistryInterface;

/**
 * Whoops
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Debug\Exception\Handler\Manager\Service
 */
class Whoops extends HandlerManager
{
    public function __construct()
    {
        parent::__construct(new HandlerRegistry());
    }
}
