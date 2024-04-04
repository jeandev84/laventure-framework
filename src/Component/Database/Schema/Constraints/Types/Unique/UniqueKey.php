<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Unique;

use Laventure\Component\Database\Schema\Constraints\ConstraintHasColumns;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueKeyInterface;

/**
 * Unique
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types\Unique
*/
class UniqueKey extends ConstraintHasColumns implements UniqueKeyInterface
{
    /**
     * @param array $columns
     * @param string $key
    */
    public function __construct(array $columns = [], string $key = '')
    {
        parent::__construct('unique', $key, $columns);
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return "UNIQUE" . $this->wrapColumnsIf();
    }
}
