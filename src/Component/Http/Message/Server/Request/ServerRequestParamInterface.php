<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Server\Request;


use Laventure\Component\Http\Message\Request\Uri;
use Psr\Http\Message\UriInterface;

/**
 * ServerRequestParamInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server\Request
*/
interface ServerRequestParamInterface
{

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
     public function getTime(): int;








     /**
      * Returns request time as float
      *
      * @return float
     */
     public function getTimeAsFloat(): float;





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
}