<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\Mysqli;

use Laventure\Component\Database\Connection\Connection;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Factory\MysqliConnectionFactory;
use Laventure\Component\Database\Connection\Extensions\Mysqli\Factory\MysqliConnectionFactoryInterface;
use mysqli;

/**
 * MysqliConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\Mysqli
*/
class MysqliConnection extends Connection implements MysqliConnectionInterface
{
    public function __construct(MysqliConnectionFactoryInterface $factory = null)
    {
        parent::__construct($factory ?: new MysqliConnectionFactory());
    }




    /**
     * @inheritDoc
    */
    public function connected(): bool
    {
        return $this->connection instanceof mysqli;
    }
}
