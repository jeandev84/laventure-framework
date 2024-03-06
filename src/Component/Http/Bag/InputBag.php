<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Bag;

/**
 * InputBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Request\Bag
 */
class InputBag extends ParameterBag
{
    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }
}
