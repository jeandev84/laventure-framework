<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Factory;

use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Resource\Exception\ResourceGeneratorException;
use Laventure\Foundation\Generator\Resource\ResourceGeneratorInterface;
use Laventure\Foundation\Generator\Resource\Types\Api\ApiResourceGenerator;
use Laventure\Foundation\Generator\Resource\Types\Web\WebResourceGenerator;
use Psr\Container\ContainerInterface;

/**
 * ResourceGeneratorFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource\Factory
 */
class ResourceGeneratorFactory implements ResourceGeneratorFactoryInterface
{
    /**
     * @var ResourceGeneratorInterface[]
    */
    protected array $lazy = [];



    /**
     * @param ContainerInterface $app
    */
    public function __construct(
        protected ContainerInterface $app
    ) {
    }



    /**
     * @inheritDoc
    */
    public function createResourceGenerator(string $type): ResourceGeneratorInterface
    {
        if (isset($this->lazy[$type])) {
            return $this->lazy[$type];
        }

        return $this->lazy[$type] = match ($type) {
            ResourceType::API => $this->app->get(ApiResourceGenerator::class),
            ResourceType::WEB => $this->app->get(WebResourceGenerator::class),
            default           => throw new ResourceGeneratorException("Unavailable resource generator type ($type)")
        };
    }
}
