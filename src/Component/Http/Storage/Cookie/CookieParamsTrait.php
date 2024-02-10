<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie;

/**
 * CookieParamsTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\Cookie
 */
trait CookieParamsTrait
{
    /**
     * @var string
     */
    protected string $name;


    /**
     * @var string
     */
    protected string $value;


    /**
     * @var int
     */
    protected int $expires = 0;



    /**
     * @var string
     */
    protected string $path = '';



    /**
     * @var string
     */
    protected string $domain = '';



    /**
     * @var bool
     */
    protected bool $secure = false;



    /**
     * @var bool
     */
    protected bool $httpOnly = false;





    /**
     * @param string $name
     * @return $this
     */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @param string $value
     * @return $this
     */
    public function value(string $value): static
    {
        $this->value = $value;

        return $this;
    }





    /**
     * @param int $times
     *
     * @return mixed
     */
    public function expireAfter(int $times): static
    {
        $this->expires = $times;

        return $this;
    }





    /**
     * @param string $path
     *
     * @return $this
     */
    public function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }




    /**
     * @param string $domain
     *
     * @return $this
    */
    public function domain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }




    /**
     * @param bool $secure
     * @return $this
    */
    public function secure(bool $secure): static
    {
        $this->secure = $secure;

        return $this;
    }




    /**
     * @param bool $httpOnly
     * @return $this
    */
    public function httpOnly(bool $httpOnly): static
    {
        $this->httpOnly = $httpOnly;

        return $this;
    }





    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @return string
    */
    public function getValue(): string
    {
        return $this->value;
    }





    /**
     * @return int
    */
    public function getExpires(): int
    {
        return $this->expires;
    }




    /**
     * @return string
    */
    public function getPath(): string
    {
        return $this->path;
    }





    /**
     * @return string
    */
    public function getDomain(): string
    {
        return $this->domain;
    }




    /**
     * @return bool
    */
    public function getSecure(): bool
    {
        return $this->secure;
    }




    /**
     * @return bool
    */
    public function getHttpOnly(): bool
    {
        return $this->httpOnly;
    }
}
