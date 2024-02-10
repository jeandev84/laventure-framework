<?php

declare(strict_types=1);

namespace Laventure\Contract\Matcher;

/**
 * MatcherInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Matcher
*/
interface MatcherInterface
{
    /**
     * Match something
     *
     * @return bool
    */
    public function match(): bool;
}
