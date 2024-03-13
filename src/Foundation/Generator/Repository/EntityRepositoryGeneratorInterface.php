<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Repository;

use Laventure\Foundation\Generator\Class\ClassGeneratorInterface;

/**
 * EntityRepositoryGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Repository
 */
interface EntityRepositoryGeneratorInterface extends ClassGeneratorInterface
{
    /**
     * Needs tou specified full path namespace of class
     *
     * @param string $entityClass
     * @return $this
    */
    public function withEntity(string $entityClass): static;
}
