<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client;

use Laventure\Utils\Parameter\Parameter;
use Psr\Http\Client\ClientInterface;

/**
 * Client
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client
 */
abstract class Client implements ClientInterface
{
    /**
     * @var array
    */
    protected array $headers = [];


    /**
     * @var array
    */
    protected array $options = [
        'query'              => null,  // type QueryParams($queries)
        'body'               => null,  // type Body($data)
        'json'               => null,  // type Json($data)
        'headers'            => null,  // type Header($headers)
        'proxy'              => null,  // type Proxy()
        'authBasic'          => null,  // type AuthBasic('YOUR_LOGIN', 'YOUR_PASSWORD')
        'authToken'          => null,  // type AuthToken('YOUR_ACCESS_TOKEN'), oAuth(), AuthBearer
        'upload'             => null,  // type Upload()
        'download'           => null,  // type Download()
        'files'              => null,  // type ClientFile[]
        'cookies'            => null,  // type ClientCookie[]
        'userAgent'          => null   // type UserAgent(...)
    ];




    /**
     * @param array $options
    */
    public function __construct(array $options = [])
    {
        $this->withOptions($options);
    }





    /**
     * @param array $options
     * @return $this
    */
    public function withOptions(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }





    /**
     * @return Parameter
    */
    public function getOptions(): Parameter
    {
        return new Parameter($this->options);
    }





    /**
     * @param $id
     * @param $default
     * @return mixed
    */
    public function getOption($id, $default = null): mixed
    {
        return $this->getOptions()->get($id, $default);
    }
}
