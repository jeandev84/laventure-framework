<?php
declare(strict_types=1);

namespace Laventure\Foundation\Loader\Repository;


use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Repository\Contract\EntityRepositoryInterface;
use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoaderInterface;

/**
 * RepositoryLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Repository
*/
interface EntityRepositoryLoaderInterface extends FilesDirectoryLoaderInterface
{

      /**
       * @return EntityRepositoryInterface[]
      */
      public function loadRepositories(EntityManagerInterface $em): array;
}