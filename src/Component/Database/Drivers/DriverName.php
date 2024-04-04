<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers;

/**
 * DriverName
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Name
*/
enum DriverName
{
    public const Mysql      = 'mysql';
    public const Pgsql      = 'pgsql';
    public const Oracle     = 'oci';
    public const Sqlite     = 'sqlite';
    public const Mysqli     = 'mysqli';
    public const SqlServer  = 'sqlserver';
}
