<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Reader;

use Laventure\Component\Templating\Template\Contract\HasTemplateInterface;
use Laventure\Contract\Reader\ReaderInterface;

/**
 * TemplateReaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Reader
*/
interface TemplateReaderInterface extends HasTemplateInterface, ReaderInterface
{
}
