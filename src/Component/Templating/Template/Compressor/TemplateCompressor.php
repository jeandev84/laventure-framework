<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compressor;

use Laventure\Component\Templating\Template\Contract\TemplateInterface;

/**
 * TemplateCompressor
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compressor
 */
class TemplateCompressor implements TemplateCompressorInterface
{
    /**
     * @var string[]
    */
    protected $search =  [
        "/(\n)+/",
        "/\r\n+/",
        "/\n(\t)+/",
        "/\n(\ )+/",
        "/\>(\n)+</",
        "/\>\r\n</",
    ];




    /**
     * @var string[]
    */
    protected $replace = [
        "\n",
        "\n",
        "\n",
        "\n",
        '><',
        '><',
    ];




    /**
     * @inheritDoc
    */
    public function compress(TemplateInterface $template): string
    {
        return preg_replace($this->search, $this->replace, strval($template));
    }
}
