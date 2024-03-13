<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Class\ClassGenerator;
use Laventure\Foundation\Generator\Class\Exception\ClassGeneratorException;
use Laventure\Foundation\Generator\Controller\ControllerGenerator;
use Laventure\Foundation\Generator\Entity\EntityGenerator;
use Laventure\Foundation\Generator\Entity\Exception\EntityGeneratorException;
use Laventure\Foundation\Generator\Resource\Exception\ResourceGeneratorException;

/**
 * ResourceGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource
*/
abstract class ResourceGenerator extends ControllerGenerator implements ResourceGeneratorInterface
{


    /**
     * @var string|null
    */
    protected ?string $resource = null;





    /**
     * @param Application $app
     * @param FilesystemInterface $filesystem
     * @param ConfigInterface $config
     * @param EntityGenerator $entityGenerator
    */
    public function __construct(
        Application $app,
        FilesystemInterface $filesystem,
        ConfigInterface $config,
        protected EntityGenerator $entityGenerator
    ) {
        parent::__construct($app, $filesystem, $config);
    }





    /**
     * @inheritDoc
    */
    public function withResource($resource): static
    {
        $this->entityGenerator->withClassName($resource);

        return $this->withController("{$resource}Controller");
    }








    /**
     * @inheritDoc
     * @throws EntityGeneratorException
    */
    public function generate(): bool
    {
        /*
        if ($status = $this->generateEntity()) {
            $status = $this->generateResourceController();
        }

        return $status;
        */

        return $this->generateResourceController();
    }





    /**
     * @inheritDoc
     * @throws EntityGeneratorException
    */
    public function generateEntity(): bool
    {
        return $this->entityGenerator->generate();
    }




    /**
     * @return string
    */
    public function getResourceName(): string
    {
        return strtolower($this->getClassName());
    }







      /**
       * Generate resource controller
       *
       * @return bool
      */
      abstract public function generateResourceController(): bool;






     /**
      * @return ResourceInterface
     */
     abstract public function getResource(): ResourceInterface;
}
