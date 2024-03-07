<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie\Jar;

use Laventure\Component\Http\Storage\Cookie\Cookie;
use Laventure\Component\Http\Storage\Cookie\CookieInterface;
use Laventure\Component\Http\Storage\Cookie\CookieParamsTrait;
use Laventure\Utils\Parameter\Parameter;

/**
 * CookieJar
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\ClientCookie\Jar
*/
class CookieJar extends Parameter implements CookieJarInterface
{
    use CookieParamsTrait;


    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        parent::__construct($params ?: $_COOKIE);
    }




    /**
     * @inheritDoc
    */
    public function set($id, $value): static
    {
        return $this->name($id)->value($value);
    }





    /**
     * @inheritDoc
    */
    public function remove($id): bool
    {
        $this->set($id, '')
             ->expireAfter(time() - 3600)
             ->save();

        return parent::remove($id);
    }





    /**
     * @inheritDoc
    */
    public function destroy(): bool
    {
        foreach (array_keys($this->all()) as $id) {
            $this->remove($id);
        }

        return $this->empty();
    }




    /**
     * @inheritdoc
    */
    public function save(): CookieInterface
    {
        return new Cookie($this);
    }
}
