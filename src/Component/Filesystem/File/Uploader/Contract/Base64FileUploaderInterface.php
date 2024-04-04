<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Uploader\Contract;

use Laventure\Component\Filesystem\File\Base64\Contract\HasBase64FileInterface;
use Laventure\Contract\Uploader\UploaderInterface;

/**
 * Base64FileUploaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Uploader\Writer
 */
interface Base64FileUploaderInterface extends UploaderInterface, HasBase64FileInterface
{
}
