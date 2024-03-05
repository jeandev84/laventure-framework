<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Factory;


use Laventure\Component\Database\Query\Builder\SQL\DML\Delete\DeleteBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Insert\InsertBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderInterface;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderInterface;

/**
 * SQLBuilderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\Factory
 */
interface SQLBuilderFactoryInterface
{

     /**
      * Create select query builder
      *
      * @return SelectBuilderInterface
     */
     public function createSelectBuilder(): SelectBuilderInterface;





     /**
      * Create insert query builder
      *
      * @return InsertBuilderInterface
     */
     public function createInsertBuilder(): InsertBuilderInterface;






     /**
      * Create update query builder
      *
      * @return UpdateBuilderInterface
     */
     public function createUpdateBuilder(): UpdateBuilderInterface;






     /**
      * Create delete query builder
      *
      * @return DeleteBuilderInterface
     */
     public function createDeleteBuilder(): DeleteBuilderInterface;
}