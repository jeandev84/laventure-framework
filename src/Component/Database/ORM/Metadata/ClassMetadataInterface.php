<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Metadata;

use Reflector;

/**
 * ClassMetadataInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Metadata
*/
interface ClassMetadataInterface
{
    /**
     * @return string
    */
    public function getClassName(): string;



    /**
     * @return Reflector
    */
    public function getReflector(): Reflector;
}
