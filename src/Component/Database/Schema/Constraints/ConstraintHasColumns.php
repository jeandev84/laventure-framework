<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints;

use Laventure\Component\Database\Schema\Column\Traits\HasColumnTrait;

/**
 * ConstraintHasColumns
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints
*/
class ConstraintHasColumns extends Constraint
{
    use HasColumnTrait;


    /**
     * @param string $type
     * @param string|null $key
     * @param array $columns
    */
    public function __construct(string $type, ?string $key = null, array $columns = [])
    {
        parent::__construct($type, $key);
        $this->withColumns($columns);
    }
}
