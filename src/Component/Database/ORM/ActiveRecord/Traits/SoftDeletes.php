<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Traits;

use Laventure\Component\Database\Schema\Column\Types\TimestampColumn;

/**
 * SoftDeletes
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Traits
 */
trait SoftDeletes
{


    /**
     * @var bool
    */
    protected $softDeletes = false;



    /**
     * @return bool
    */
    public function hasSoftDeletes(): bool
    {
        return $this->softDeletes;
    }





    /**
     * Returns deleted at column
     *
     * @return string
    */
    public function getDeletedAt(): string
    {
         return TimestampColumn::deletedAt();
    }





    /**
     * Returns soft delete timestamps
     *
     * @return string[]
    */
    public function getSoftDeletes(): array
    {
        return [$this->getDeletedAt() => date('Y-m-d H:i:s')];
    }
}
