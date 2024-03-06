<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Bag;

use Laventure\Component\Http\Message\Request\Utils\Params\ServerParams;

/**
 * ServerBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Request\Bag
 */
class ServerBag extends ServerParams
{
    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }
}
