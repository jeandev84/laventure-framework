<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Curl;

use CURLFile;
use CurlHandle;
use Laventure\Component\Http\Client\Options\Auth\AuthBasic;
use Laventure\Component\Http\Client\Options\Auth\AuthToken;
use Laventure\Component\Http\Client\Options\Body;
use Laventure\Component\Http\Client\Options\ClientCookie;
use Laventure\Component\Http\Client\Options\ClientFile;
use Laventure\Component\Http\Client\Options\Download;
use Laventure\Component\Http\Client\Options\Header;
use Laventure\Component\Http\Client\Options\Json;
use Laventure\Component\Http\Client\Options\Proxy;
use Laventure\Component\Http\Client\Options\Upload;
use Laventure\Component\Http\Client\Options\UserAgent;

/**
 * CurlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Curl
 */
class CurlRequest
{
    /**
     * @var CurlHandle|false
    */
    protected $ch;




    /**
     * @var string
    */
    protected string $method;





    /**
     * @var Download
    */
    protected $download;





    /**
     * @var array|string
    */
    protected mixed $data = null;




    /**
     * @var array
    */
    protected array $headers = [];





    /**
     * @var CURLFile[]
    */
    protected array $files = [];





    /**
     * @var array
    */
    protected array $defaultOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER         => false
    ];




    /**
     * @var string[]
     */
    protected $browserHeaders = [
        'cache-control: max-age=0',
        'upgrade-insecure-requests: 1',
        'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
        'sec-fetch-user: ?1',
        'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
        'x-compress: null',
        'sec-fetch-site: none',
        'sec-fetch-mode: navigate',
        'accept-encoding: deflate, br',
        'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
    ];





    /**
     * @param string $url
     * @param string $method
    */
    public function __construct(string $url, string $method = 'GET')
    {
        $this->ch = curl_init($url);
        $this->method($method);
    }





    /**
     * @param string $method
     * @return $this
    */
    public function method(string $method): static
    {
        switch ($method):
            case 'POST':
                $this->setOption(CURLOPT_POST, 1);
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                $this->setOption(CURLOPT_CUSTOMREQUEST, $method);
                break;
        endswitch;

        $this->method = $method;

        return $this;
    }





    /**
     * @param Body $body
     * @return $this
    */
    public function body(Body $body): static
    {
        $this->data = $body->data;

        return $this;
    }



    /**
     * @param Json $json
     * @return $this
    */
    public function json(Json $json): static
    {
        $this->data = $json->data;

        return $this;
    }



    /**
     * @param Header[] $headers
     *
     * @return $this
    */
    public function headers(array $headers): static
    {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }

        return $this;
    }





    /**
     * @param $name
     * @param $value
     * @return $this
    */
    public function header($name, $value): static
    {
        $this->headers[$name] = "$name: $value";

        return $this;
    }





    /**
     * @param Header $header
     * @return $this
    */
    public function addHeader(Header $header): static
    {
        return $this->header($header->name, $header->value);
    }






    /**
     * @param Proxy $proxy
     * @return $this
    */
    public function proxy(Proxy $proxy): static
    {
        return $this->setOptions([
            CURLOPT_TIMEOUT => $proxy->timeout,
            CURLOPT_PROXY   => $proxy->value
        ]);
    }







    /**
     * @param AuthBasic $payload
     * @return $this
    */
    public function authBasic(AuthBasic $payload): static
    {
        return $this->setOption(CURLOPT_USERPWD, $payload->toString());
    }






    /**
     * here we can give instance of AuthToken like AuthBearer, oAuth ...
     * @param AuthToken $token
     * @return $this
    */
    public function authToken(AuthToken $token): static
    {
        return $this->header('Authorization', $token->accessToken);
    }





    /**
     * @param Upload $upload
     * @return CurlRequest
    */
    public function upload(Upload $upload): static
    {
        $this->setOptions([
            CURLOPT_PUT => true,
            CURLOPT_UPLOAD => true,
            CURLOPT_INFILESIZE => filesize($upload->file),
            CURLOPT_INFILE => $upload->resource
        ]);

        return $this;
    }





    /**
     * First method download file
     *
     * @param Download $download
     *
     * @return mixed
    */
    public function download(Download $download): mixed
    {
        $resource = $download->resource;
        $this->setOption(CURLOPT_FILE, $resource);

        return $this;
    }





    /**
     * @param ClientFile[] $files
     * @return $this
    */
    public function files(array $files): static
    {
        foreach ($files as $id => $file) {
            $this->file($id, $file);
        }

        return $this;
    }





    /**
     * @param $id
     * @param ClientFile $file
     *
     * @return $this
    */
    public function file($id, ClientFile $file): static
    {
        $this->files[$id] = new CURLFile(
            $file->path,
            $file->mimeType,
            $file->filename
        );

        return $this;
    }





    /**
     * @param ClientCookie[] $cookies
     * @return $this
    */
    public function cookies(array $cookies): static
    {
        foreach ($cookies as $cookie) {
            $this->cookie($cookie);
        }

        return $this;
    }







    /**
     * @param ClientCookie $cookie
     * @return $this
    */
    public function cookie(ClientCookie $cookie): static
    {
        $curl = $this->setOptions([
            CURLOPT_COOKIEFILE =>  $cookie->cookieFile,
            CURLOPT_COOKIEJAR  =>  $cookie->cookieFile
        ]);

        if ($cookieParams = $cookie->toStringParams()) {
            $curl->header('Cookie', $cookieParams);
        }

        return $curl;
    }






    /**
     * @param UserAgent $agent
     * @return $this
    */
    public function userAgent(UserAgent $agent): static
    {
        $this->setOptions([
            CURLOPT_USERAGENT => $agent->name,
            CURLOPT_HEADER    => true
        ]);

        $headers       = array_merge($this->browserHeaders, $agent->headers);
        $this->headers = array_merge($this->headers, $headers);

        return $this->cookie(new ClientCookie($agent->cookieFile));
    }





    /**
     * @param array $options
     * @return $this
    */
    public function options(array $options): static
    {
        foreach ($options as $method => $value) {
            if (!empty($value)) {
                if (method_exists($this, $method)) {
                    call_user_func_array([$this, $method], [$value]);
                }
            }
        }

        return $this;
    }









    /**
     * @return CurlResponse
    */
    public function send(): CurlResponse
    {
        // terminate options setting
        $this->flushOptions();

        return new CurlResponse($this);
    }







    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setOption($id, $value): static
    {
        curl_setopt($this->ch, $id, $value);

        return $this;
    }





    /**
     * @param array $options
     * @return $this
    */
    public function setOptions(array $options): static
    {
        curl_setopt_array($this->ch, $options);

        return $this;
    }






    /**
     * @return string|false
     */
    public function exec(): string|false
    {
        return curl_exec($this->ch);
    }






    /**
     * @return void
    */
    public function close(): void
    {
        curl_close($this->ch);
    }




    /**
     * @return void
    */
    public function reset(): void
    {
        curl_reset($this->ch);
    }




    /**
     * @return int
     */
    public function errno(): int
    {
        return curl_errno($this->ch);
    }




    /**
     * @return string
    */
    public function error(): string
    {
        return curl_error($this->ch);
    }






    /**
     * @return mixed
    */
    public function infos(): mixed
    {
        return curl_getinfo($this->ch);
    }





    /**
     * @param int $key
     * @return mixed
    */
    public function info(int $key): mixed
    {
        return curl_getinfo($this->ch, $key);
    }






    /**
     * @return void
    */
    private function flushOptions(): void
    {
        if (in_array($this->method, ['POST', 'PUT', 'PATCH'])) {
            $this->setOption(CURLOPT_POSTFIELDS, $this->getPostFields());
        }

        $this->setOptions([
            CURLOPT_HTTPHEADER => array_values($this->headers)
        ]);
    }






    /**
     * @return array
    */
    private function getPostFields(): array
    {
        return array_merge(
            (array)$this->data,
            $this->files
        );
    }
}
