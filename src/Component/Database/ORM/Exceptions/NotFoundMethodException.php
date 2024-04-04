<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Exceptions;

use Laventure\Exceptions\BaseException;

/**
 * NotFoundMethodException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Exceptions
*/
class NotFoundMethodException extends BaseException
{

     /**
      * @param string $targetClass
      * @param string $method
      * @param array $data
     */
     public function __construct(string $targetClass, string $method, array $data = [])
     {
         parent::__construct("Not found method ($method) in class ($targetClass)", $data, 404);
     }
}