<?php

declare(strict_types=1);

namespace Laventure\Contract\Transformer;

/**
 * TransformerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Transformer
 */
interface TransformerInterface
{
    /**
     * Transform something
     *
     * @return mixed
    */
    public function transform(): mixed;
}
