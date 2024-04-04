<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Handlers\Contract;

use Psr\Http\Message\ResponseInterface;

/**
 * PipelineInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Handlers\Writer
 */
interface PipelineInterface
{
    /**
     * @param array $middlewares
     * @return mixed
    */
    public function pipe(array $middlewares): mixed;




    /**
     * @param $request
     * @return mixed
    */
    public function handle($request): mixed;
}
