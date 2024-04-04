<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Controller;

use Laventure\Component\Container\Common\ContainerAwareTrait;
use Laventure\Component\Container\ContainerAwareInterface;
use Laventure\Component\Database\ORM\Manager\Registry\ManagerRegistryInterface;
use Laventure\Component\Http\Message\Response\JsonResponse;
use Laventure\Component\Http\Message\Response\RedirectResponse;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Component\Routing\Router\RouterInterface;
use Laventure\Component\Templating\Renderer\RendererInterface;

/**
 * AbstractController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Controller
 */
abstract class AbstractController implements ContainerAwareInterface
{
    use ContainerAwareTrait;



    /**
     * @param string $template
     * @param array $data
     * @return string
    */
    public function renderView(string $template, array $data = []): string
    {
        return $this->container[RendererInterface::class]->render($template, $data);
    }



    /**
     * @param string $template
     * @param array $data
     * @return Response
    */
    public function render(string $template, array $data = []): Response
    {
        $response = new Response();
        $response->setContent($this->renderView($template, $data));
        return $response;
    }




    /**
     * @param array|object $data
     *
     * @return JsonResponse
    */
    public function json(array|object $data): JsonResponse
    {
        return new JsonResponse($data);
    }





    /**
     * Returns manager registry
     *
     * @return ManagerRegistryInterface
    */
    public function getRegistry(): ManagerRegistryInterface
    {
        return $this->container[ManagerRegistryInterface::class];
    }





    /**
     * @param string $name
     * @param array $params
     * @return string
    */
    public function generatePath(string $name, array $params = []): string
    {
        return $this->container[RouterInterface::class]->generate($name, $params);
    }




    /**
     * @param string $path
     * @return RedirectResponse
    */
    public function redirectTo(string $path): RedirectResponse
    {
        return new RedirectResponse($path);
    }





    /**
     * @param string $name
     * @param array $params
     * @return RedirectResponse
    */
    public function redirectToRoute(string $name, array $params = []): RedirectResponse
    {
        return $this->redirectTo($this->generatePath($name, $params));
    }




    /**
     * @param string $type
     * @param string $message
     * @return $this
    */
    public function addFlash(string $type, string $message): static
    {
        return $this;
    }





    /**
     * @param string $form
     * @param $data
     * @param array $options
     * @return mixed
    */
    public function createForm(string $form, $data, array $options = []): mixed
    {
        return '';
    }
}
