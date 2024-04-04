<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Server\Headers;

use Laventure\Component\Http\Message\Request\Server\ServerParamInterface;

/**
 * ServerHeaderParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server\Headers
*/
class ServerHeaderParams implements ServerHeaderInterface
{
    /**
     * @param ServerParamInterface $server
    */
    public function __construct(protected ServerParamInterface $server)
    {
    }





    /**
     * @inheritDoc
    */
    public function all(): array
    {
        if (! function_exists('getallheaders')) {
            return [];
        }

        return getallheaders();
    }




    /**
     * @inheritDoc
    */
    public function map(): array
    {
        $headers = [];

        foreach ($this->server->all() as $key => $value) {
            if(strpos($key, 'HTTP_') === 0) {
                $headers[substr($key, 5)] = $value;
            } elseif (\in_array($key, ['CONTENT_TYPE', 'CONTENT_LENGTH', 'CONTENT_MD5'], true)) {
                $headers[$key] = $value;
            }
        }

        return $headers;
    }
}
