<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Fixtures\Factory;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Manager\Fixtures\FixtureManager;
use Laventure\Component\Database\ORM\Manager\Fixtures\FixtureManagerInterface;

/**
 * FixtureManagerFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Manager\Fixtures\Factory
*/
class FixtureManagerFactory implements FixtureManagerFactoryInterface
{


    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(
        protected EntityManagerInterface $em
    )
    {
    }



    /**
     * @inheritDoc
    */
    public function create(): FixtureManagerInterface
    {
         return new FixtureManager($this->em);
    }
}