<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;


use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * BlueprintInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint
*/
interface BlueprintInterface extends TableInterface
{
     /**
      * @param $name
      * @param $type
      * @param array $options
      * @return static
     */
     public function addColumn($name, $type, array $options = []): static;


     /**
      * @param string|array $columns
      * @return $this
     */
     public function dropColumn(string|array $columns): static;




     /**
      * @return mixed
     */
     public function id(): mixed;




     /**
      * @param $name
      * @return mixed
     */
     public function string($name): mixed;





     /**
      * @param $name
      * @return mixed
     */
     public function datetime($name): mixed;
}