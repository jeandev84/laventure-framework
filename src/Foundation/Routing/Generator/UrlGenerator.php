<?php

declare(strict_types=1);

namespace Laventure\Foundation\Routing\Generator;

use Laventure\Component\Http\Message\Request\Uri;
use Laventure\Component\Routing\Router\RouterInterface;
use Laventure\Foundation\Http\Message\Request\Constract\CustomRequestInterface;

/**
 * UrlGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Generator
*/
class UrlGenerator implements UrlGeneratorInterface
{

    /**
     * @param RouterInterface $router
     * @param CustomRequestInterface $request
    */
    public function __construct(
        protected RouterInterface $router,
        protected CustomRequestInterface $request
    ) {

    }






    /**
     * @inheritDoc
    */
    public function generate(
        string $name,
        array $parameters = [],
        array $queries = [],
        string $fragment = null
    ): string
    {
        return $this->generateUri($name, $parameters, $queries, $fragment);
    }



    /**
     * @inheritDoc
    */
    public function generateUri(string $name, array $parameters = [], array $queries = [], string $fragment = null): string
    {
        if (!$path = $this->router->generate($name, $parameters)) {
            throw new UrlGeneratorException("Could not generate route '$name'");
        }

        $uri = new Uri();
        $uri->withPath($path)
            ->withQuery($this->buildQuery($queries))
            ->withFragment($fragment);

        return strval($uri);
    }





    /**
     * @param array $queries
     * @return string
    */
    public function buildQuery(array $queries): string
    {
        return http_build_query(
            array_merge($this->queries, $queries)
        );
    }
}
