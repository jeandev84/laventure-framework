<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Pagination;


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

       /**
        * @param int $page
        * @param int $limit
        * @return array
       */
       public function paginate(int $page, int $limit): array;
}