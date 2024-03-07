<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder;


use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Delete\Delete;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Insert\Insert;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DML\Update\Update;
use Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\DQL\Select\Select;

/**
 * QueryBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder
*/
interface QueryBuilderInterface
{

     /**
      * @param $columns
     */
     public function select($columns = null): Select;





     /**
      * @param string $table
      * @param array $attributes
     */
     public function insert(string $table, array $attributes): Insert;






     /**
      * @param string $table
      * @param array $attributes
      * @return Update
     */
     public function update(string $table, array $attributes): Update;








     /**
      * @param string $table
      * @return Delete
     */
     public function delete(string $table): Delete;
}