<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions;

/**
 * ExtensionType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions
*/
enum ExtensionType
{
    public const Pdo    = 'pdo';
    public const Mysqli = 'mysqli';
}
