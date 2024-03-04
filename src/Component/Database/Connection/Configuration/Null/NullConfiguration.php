<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Configuration\Null;

use Laventure\Component\Database\Connection\Configuration\Configuration;

/**
 * NullConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Configuration\Null
*/
class NullConfiguration extends Configuration
{
    public function __construct()
    {
        parent::__construct([]);
    }
}
