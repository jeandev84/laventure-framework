<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli;


use mysqli;

/**
 * MysqliConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\Mysqli
*/
interface MysqliConnectionInterface
{

     /**
      * @return mysqli
     */
     public function getMysqli(): mysqli;
}