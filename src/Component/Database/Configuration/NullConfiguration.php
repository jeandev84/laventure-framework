<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Configuration;

/**
 * NullConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Configuration
*/
class NullConfiguration extends Configuration
{
    public function __construct()
    {
        parent::__construct([]);
    }
}
