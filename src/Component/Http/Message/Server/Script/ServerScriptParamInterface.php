<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Server\Script;


/**
 * ServerScriptParamInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Server\Script
*/
interface ServerScriptParamInterface
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