<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Service;

/**
 * SharedService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Service
*/
class SharedService extends Service
{
    /**
     * @param string $id
     * @param mixed $value
    */
    public function __construct(string $id, mixed $value)
    {
        parent::__construct($id, $value, true);
    }
}
