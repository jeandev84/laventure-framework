<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Server\Headers;


/**
 * ServerHeaderParamInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server\Headers
*/
interface ServerHeaderParamInterface
{

       /**
        * @return array
       */
       public function all(): array;



       /**
        * @return array
       */
       public function map(): array;
}