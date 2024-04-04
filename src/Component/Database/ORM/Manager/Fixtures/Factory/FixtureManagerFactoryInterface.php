<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Fixtures\Factory;


use Laventure\Component\Database\ORM\Manager\Fixtures\FixtureManagerInterface;

/**
 * FixtureManagerFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Manager\Fixtures\Factory
 */
interface FixtureManagerFactoryInterface
{

     /**
      * @return FixtureManagerInterface
     */
     public function create(): FixtureManagerInterface;
}