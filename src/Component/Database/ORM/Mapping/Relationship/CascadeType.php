<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Relationship;

/**
 * CascadeType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Relationship
*/
class CascadeType
{
    const PERSIST = 'persist';
    const REMOVE  = 'remove';
    const ALL     = [
        self::PERSIST,
        self::REMOVE
    ];
}