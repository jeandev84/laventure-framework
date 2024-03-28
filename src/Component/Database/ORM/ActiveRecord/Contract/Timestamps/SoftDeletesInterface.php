<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Contract\Timestamps;


/**
 * SoftDeletesInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Contract
 */
interface SoftDeletesInterface
{
    /**
     * Returns soft delete timestamps
     *
     * @return string[]
    */
    public function getSoftDeleteTimestamps(): array;
}