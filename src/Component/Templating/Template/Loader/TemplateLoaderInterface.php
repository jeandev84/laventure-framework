<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Loader;

use Laventure\Component\Templating\Template\Contract\HasTemplateInterface;
use Laventure\Contract\Loader\LoaderInterface;

/**
 * TemplateEngineLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine\Loader
*/
interface TemplateLoaderInterface extends LoaderInterface, HasTemplateInterface
{
}
