<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Server;

use Laventure\Component\Http\Message\Request\Server\Headers\ServerHeaderInterface;
use Laventure\Component\Http\Message\Request\Server\Protocol\ServerProtocolInterface;
use Laventure\Component\Http\Message\Request\Server\Remote\ServerRemoteInterface;
use Laventure\Component\Http\Message\Request\Server\Script\ServerScriptInterface;
use Laventure\Contract\Parameter\ParameterInterface;
use Psr\Http\Message\UriInterface;

/**
 * ServerParamInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server
 */
interface ServerParamInterface extends ParameterInterface
{
    /**
     * Returns name of server
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Returns request method name
     *
     * @return string
     */
    public function getMethod(): string;






    /**
     * Set request method
     *
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method): static;








    /**
     * Returns request uri from sever
     *
     * @return string
     */
    public function getRequestUri(): string;








    /**
     * Returns request time
     *
     * @return int
     */
    public function getRequestTime(): int;








    /**
     * Returns request time as float
     *
     * @return float
     */
    public function getRequestTimeAsFloat(): float;





    /**
     * Returns referer
     *
     * @return string
     */
    public function getReferer(): string;




    /**
     * Returns PHP SELF path
     *
     * @return string
     */
    public function getSelfPath(): string;






    /**
     * @return string
     */
    public function getBaseUrl(): string;







    /**
     * @return string
     */
    public function getUrl(): string;







    /**
     * Returns scheme protocol
     *
     * @return string
     */
    public function getScheme(): string;






    /**
     * Returns username
     *
     * @return string
     */
    public function getUsername(): string;







    /**
     * Returns user password
     *
     * @return string
     */
    public function getPassword(): string;







    /**
     * Returns authority
     *
     * @return string
     */
    public function getAuthority(): string;






    /**
     * Returns port
     *
     * @return int
     */
    public function getPort(): int;






    /**
     * Returns host
     *
     * @return string
     */
    public function getHost(): string;







    /**
     * Returns query string
     *
     * @return string
     */
    public function getQueryString(): string;







    /**
     * Returns URI
     *
     * @return UriInterface
    */
    public function getUri(): UriInterface;






    /**
     * Returns path info
     *
     * @return string
    */
    public function getPathInfo(): string;






    /**
     * Determine if the given host is valid
     *
     * @param $host
     * @return bool
    */
    public function isValidHost($host): bool;







    /**
     * Determine if the HTTP protocol is secure
     *
     * @return bool
    */
    public function isSecure(): bool;






    /**
     * Determine if the request is HTTPS
     *
     * @return bool
    */
    public function isHttps(): bool;






    /**
     * Determine if request via xhr http request
     *
     * @return bool
    */
    public function isXhr(): bool;






    /**
     * Determine if request via xhr http request
     *
     * @return bool
    */
    public function isForwardedProto(): bool;





    /**
     * Returns headers information
     *
     * @return ServerHeaderInterface
    */
    public function getHeaders(): ServerHeaderInterface;






    /**
     * Returns information server protocol
     *
     * @return ServerProtocolInterface
    */
    public function getProtocol(): ServerProtocolInterface;








    /**
     * Returns document root
     *
     * @return string
    */
    public function getDocumentRoot(): string;






    /**
     * @return ServerScriptInterface
    */
    public function getScript(): ServerScriptInterface;








    /**
     * Returns remote information
     *
     * @return ServerRemoteInterface
    */
    public function getRemote(): ServerRemoteInterface;
}
