<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapper\Data\Factory;


use Laventure\Component\Database\ORM\Mapper\Data\DataMapperInterface;

/**
 * DataMapperFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Data\Factory
*/
interface DataMapperFactoryInterface
{
     /**
      * @return DataMapperInterface
     */
     public function createDataMapper(): DataMapperInterface;
}