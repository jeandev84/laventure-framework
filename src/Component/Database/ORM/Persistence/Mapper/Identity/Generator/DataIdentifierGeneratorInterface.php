<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Identity\Generator;


use Laventure\Contract\Generator\IdentifierGeneratorInterface;

/**
 * DataIdentifierGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapper\Identity\Generator
 */
interface DataIdentifierGeneratorInterface extends IdentifierGeneratorInterface
{
     /**
      * @param $class
      * @return $this
     */
     public function withClass($class): static;



     /**
      * @param $id
      * @return $this
     */
     public function withRecordId($id): static;
}