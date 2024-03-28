<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Contract\Timestamps;


/**
 * TimestampsInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Contract
*/
interface TimestampsInterface
{
    /**
     * Returns timestamp like created_at, updated_at
     *
     * @return string[]
    */
    public function getTimestamps(): array;
}