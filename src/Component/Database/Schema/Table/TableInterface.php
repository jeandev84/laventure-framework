<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;


/**
 * TableInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table
*/
interface TableInterface
{
      /**
       * Create table
       *
       * @return mixed
      */
      public function create(): mixed;


      /**
       * Update table
       *
       * @return mixed
      */
      public function update(): mixed;




      /**
       * Drop table
       *
       * @return mixed
      */
      public function drop(): mixed;




      /**
       * Drop table if exist
       *
       * @return mixed
      */
      public function dropIfExists(): mixed;





      /**
       * Truncate table
       *
       * @return mixed
      */
      public function truncate(): mixed;





      /**
       * @return mixed
      */
      public function truncateCascade(): mixed;





      /**
       * Determine if table exists
       *
       * @return bool
      */
      public function exists(): bool;





      /**
       * List tables
       *
       * @return array
      */
      public function list(): array;





      /**
       * Returns table columns
       *
       * @return array
      */
      public function getColumns(): array;





      /**
       * Determine if column exist in table
       *
       * @param string $name
       * @return bool
      */
      public function hasColumn(string $name): bool;




      /**
       * Returns table name
       *
       * @return string
      */
      public function getName(): string;
}