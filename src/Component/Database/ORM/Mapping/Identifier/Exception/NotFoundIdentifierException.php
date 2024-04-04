<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Identifier\Exception;

use Laventure\Exceptions\BaseException;

/**
 * NotFoundIdentifierException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Metadata\Types\Identifier\Exception
*/
class NotFoundIdentifierException extends BaseException
{
     public function __construct(string $classname, array $data = [])
     {
         parent::__construct("Not found id inside ($classname)", $data, 404);
     }
}