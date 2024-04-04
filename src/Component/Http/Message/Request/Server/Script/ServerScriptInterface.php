<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Server\Script;

/**
 * ServerScriptInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Server\Script
*/
interface ServerScriptInterface
{
    /**
     * Returns script name
     *
     * @return string
    */
    public function getName(): string;





    /**
     * Returns script file
     *
     * @return string
    */
    public function getFileName(): string;
}
