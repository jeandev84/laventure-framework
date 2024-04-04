<?php
declare(strict_types=1);

namespace Laventure\Foundation\Loader\Fixture;


use Laventure\Component\Database\ORM\Manager\Fixtures\Fixture;
use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoaderInterface;

/**
 * FixtureLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Fixtures
*/
interface FixtureLoaderInterface extends FilesDirectoryLoaderInterface
{

      /**
       * @return Fixture[]
     */
     public function loadFixtures(): array;
}