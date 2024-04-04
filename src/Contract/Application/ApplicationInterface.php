<?php

declare(strict_types=1);

namespace Laventure\Contract\Application;

/**
 * ApplicationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Application
*/
interface ApplicationInterface
{
    /**
     * Returns the name of application
     *
     * @return string|mixed
    */
    public function getName(): mixed;




    /**
     * Returns version of application
     *
     * @return string|mixed
    */
    public function getVersion(): mixed;
}
