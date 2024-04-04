<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session;

use Laventure\Component\Http\Storage\Session\Cache\SessionCacheInterface;
use Laventure\Component\Http\Storage\Session\Cookies\SessionCookie;
use Laventure\Component\Http\Storage\Session\Cookies\SessionCookieInterface;
use Laventure\Component\Http\Storage\Session\Encoder\SessionEncoder;
use Laventure\Component\Http\Storage\Session\Encoder\SessionEncoderInterface;
use Laventure\Component\Http\Storage\Session\Exception\SessionException;
use Laventure\Component\Http\Storage\Session\Flash\SessionFlash;
use Laventure\Component\Http\Storage\Session\Flash\SessionFlashInterface;
use Laventure\Component\Http\Storage\Session\Id\SessionId;
use Laventure\Component\Http\Storage\Session\Id\SessionIdInterface;
use Laventure\Component\Http\Storage\Session\Module\SessionModule;
use Laventure\Component\Http\Storage\Session\Module\SessionModuleInterface;
use Laventure\Component\Http\Storage\Session\Name\SessionName;
use Laventure\Component\Http\Storage\Session\Name\SessionNameInterface;

/**
 * Session ( This is used for unit testing for example )
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Session
*/
class Session implements SessionInterface
{
    /**
     * @var SessionCacheInterface
    */
    protected SessionCacheInterface $cache;



    /**
     * @var string
    */
    protected string $sessionPath;



    /**
     * @param SessionCacheInterface $cache
    */
    public function __construct(SessionCacheInterface $cache)
    {
        $this->cache = $cache;
    }



    /**
     * @inheritdoc
    */
    public function status(): int
    {
        return session_status();
    }




    /**
     * @inheritDoc
     */
    public function start(): void
    {
        session_start();
    }





    /**
     * @inheritDoc
     */
    public function abort(): bool
    {
        return session_abort();
    }




    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return session_commit();
    }





    /**
     * @inheritDoc
     */
    public function reset(): bool
    {
        return session_reset();
    }





    /**
     * @inheritDoc
     */
    public function unset(): bool
    {
        return session_unset();
    }





    /**
     * @inheritDoc
     */
    public function close(): bool
    {
        return session_write_close();
    }





    /**
     * @inheritDoc
     */
    public function gc(): false|int
    {
        return session_gc();
    }





    /**
     * @inheritDoc
     */
    public function register(string $name = null): void
    {
        session_register_shutdown();
    }






    /**
     * @inheritDoc
     */
    public function id(): SessionIdInterface
    {
        return new SessionId();
    }



    /**
     * @inheritDoc
     */
    public function name(): SessionNameInterface
    {
        return new SessionName();
    }




    /**
     * @inheritDoc
     */
    public function module(): SessionModuleInterface
    {
        return new SessionModule();
    }





    /**
     * @inheritDoc
     */
    public function flash(): SessionFlashInterface
    {
        return new SessionFlash($this);
    }




    /**
     * @inheritDoc
     */
    public function cache(): SessionCacheInterface
    {
        return $this->cache;
    }




    /**
     * @inheritDoc
     */
    public function encoder(): SessionEncoderInterface
    {
        return new SessionEncoder();
    }




    /**
     * @inheritDoc
     */
    public function cookie(): SessionCookieInterface
    {
        return new SessionCookie();
    }





    /**
     * @inheritDoc
     */
    public function set($id, $value): static
    {
        $_SESSION[$id] = $value;

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function has($id): bool
    {
        return isset($_SESSION[$id]);
    }





    /**
     * @inheritDoc
    */
    public function get($id, $default = null): mixed
    {
        return $_SESSION[$id] ?? $default;
    }





    /**
     * @inheritDoc
    */
    public function remove($id): bool
    {
        unset($_SESSION[$id]);

        return !$this->has($id);
    }




    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return $_SESSION;
    }





    /**
     * @inheritDoc
     */
    public function destroy(): bool
    {
        return session_destroy();
    }



    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }




    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }




    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }






    /**
     * @param string $path
     * @return void
    */
    public function savePath(string $path): void
    {

    }




    /**
     * @inheritDoc
    */
    public function add(array $params): static
    {
        $_SESSION = array_merge($_SESSION, $params);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return count($_SESSION);
    }



    /**
     * @inheritDoc
    */
    public function required($key): mixed
    {
        if ($this->isEmpty($key)) {
            throw new SessionException("session key $key is required.");
        }

        return $this->get($key);
    }





    /**
     * @inheritDoc
    */
    public function isEmpty($key): bool
    {
        return empty($_SESSION[$key]);
    }





    /**
     * @inheritDoc
    */
    public function sessionPath(string $path): static
    {
        $this->sessionPath = $path;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function save(): bool
    {
        return false;
    }
}
