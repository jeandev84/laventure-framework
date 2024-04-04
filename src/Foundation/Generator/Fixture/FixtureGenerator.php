<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Fixture;

use Laventure\Foundation\Generator\Class\ClassGenerator;

/**
 * FixtureGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Fixture
*/
class FixtureGenerator extends ClassGenerator implements FixtureGeneratorInterface
{

    const PREFIX = 'database.orm.persistence.';



    /**
     * @param string $classname
     * @return $this
    */
    public function withClassName(string $classname): static
    {
        return parent::withClassName(sprintf('%sFixture', $classname));
    }




    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return $this->config[self::PREFIX .'fixtures.prefix'];
    }






    /**
     * @inheritDoc
    */
    public function getBaseDir(): string
    {
        return $this->config[self::PREFIX .'fixtures.dir'];
    }






    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
         return __DIR__.'/stub/fixture.stub';
    }



    /**
     * @inheritDoc
    */
    public function generate(): bool
    {
        return parent::generate();
    }
}