<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\ORM\Mapper\Fixtures;

use Laventure\Utils\Parameter\Parameter;

/**
 * FixturesConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config\ORM\Data\Fixtures
*/
class FixturesConfiguration extends Parameter implements FixturesConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function dir(): string
    {
        return $this->required('dir');
    }



    /**
     * @inheritDoc
     */
    public function prefix(): string
    {
        return $this->required('prefix');
    }
}
