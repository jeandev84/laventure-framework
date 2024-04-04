<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Index;

use Laventure\Component\Database\Schema\Constraints\ConstraintHasColumns;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;

/**
 * Index
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Drivers
*/
class Index extends ConstraintHasColumns implements IndexInterface
{
    /**
     * @param array $columns
     * @param string $key
    */
    public function __construct(array $columns, string $key = '')
    {
        parent::__construct('index', $key, $columns);
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return "INDEX" . $this->wrapColumns();
    }
}
