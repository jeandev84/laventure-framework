<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Oracle;

/**
 * Oracle
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Oracle
*/
abstract class Oracle implements OracleConnectionInterface
{
    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return 'oci';
    }
}