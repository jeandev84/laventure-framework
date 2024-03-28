<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DQL\Select;


/**
 * PaginatedQueryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DQL\Select
*/
interface PaginatedQueryInterface
{

//     /**
//      * @return int
//     */
//     public function getTotalMaxResults(): int;
//
//
//
//     /**
//      * @return int
//     */
//     public function getOffsetResult(): int;





     /**
      * @param int $page
      * @return array
     */
     public function paginate(int $page): array;
}