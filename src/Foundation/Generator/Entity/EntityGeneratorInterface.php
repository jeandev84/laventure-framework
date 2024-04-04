<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Entity;

use Laventure\Foundation\Generator\Class\ClassGeneratorInterface;
use Laventure\Foundation\Generator\Repository\EntityRepositoryGeneratorInterface;

/**
 * EntityGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Entity
 */
interface EntityGeneratorInterface extends ClassGeneratorInterface
{
    /**
     * Generate entity repository
     *
     * @return bool
    */
    public function generateRepository(): bool;




    /**
     * Returns entity repository target path
     *
     * @return string
    */
    public function getRepositoryPath(): string;




    /**
     * Returns entity repository generator
     *
     * @return EntityRepositoryGeneratorInterface
    */
    public function getEntityRepositoryGenerator(): EntityRepositoryGeneratorInterface;
}
