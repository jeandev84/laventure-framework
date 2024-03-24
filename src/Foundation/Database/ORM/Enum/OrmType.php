<?php
declare(strict_types=1);

namespace Laventure\Foundation\Database\ORM\Enum;

/**
 * OrmType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\ORM\Enum
 */
enum OrmType
{
    public const Mapper   = 'mapper'; // used data mapper pattern  (persistence)
    public const Model    = 'model';  // used active record pattern
}
