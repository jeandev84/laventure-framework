<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Attributes;

use Attribute;

/**
 * Entity
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Attributes
 */
#[Attribute(
    Attribute::TARGET_CLASS
)]
class Entity
{
      /**
       * @param string $repositoryClass
      */
      public function __construct(
          protected string $repositoryClass
      )
      {
      }




      /**
       * @return string
      */
      public function getRepositoryClass(): string
      {
          return $this->repositoryClass;
      }
}