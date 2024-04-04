<?php
declare(strict_types=1);

namespace Laventure\Contract\Encoder;


/**
 * JsonEncoderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Encoder
*/
interface JsonEncoderInterface
{
      /**
       * @param array $data
       * @return string
      */
      public function encode(array $data): string;
}