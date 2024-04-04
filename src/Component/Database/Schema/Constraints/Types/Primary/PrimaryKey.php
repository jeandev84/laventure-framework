<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Primary;

use Laventure\Component\Database\Schema\Constraints\ConstraintHasColumns;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;

/**
 * PrimaryKey
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Drivers\Keys\Primary
*/
class PrimaryKey extends ConstraintHasColumns implements PrimaryKeyInterface
{
    /**
     * @param array $columns
     * @param string $key
    */
    public function __construct(array $columns = [], string $key = '')
    {
        parent::__construct('primaryKey', $key, $columns);
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return "PRIMARY KEY" . $this->wrapColumnsIf();
    }
}
