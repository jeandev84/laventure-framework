<?php

declare(strict_types=1);

namespace PHPUnitTest\Component\Templating\Template\Engine\Config;

use Laventure\Component\Templating\Template\Compiler\TemplateCompiler;
use Laventure\Component\Templating\Template\Compiler\TemplateCompilerInterface;
use Laventure\Component\Templating\Template\Engine\Config\TemplateEngineConfig;
use Laventure\Component\Templating\Template\Loader\TemplateLoaderInterface;
use Laventure\Component\Templating\Template\Reader\TemplateReaderInterface;
use PHPUnit\Framework\TestCase;

/**
 * TemplateEngineConfigTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Templating\Template\Engine\Common
*/
class TemplateEngineConfigTest extends TestCase
{
    public function testItMapParameters(): void
    {
        $config = new TemplateEngineConfig();


        $this->assertInstanceOf(TemplateCompiler::class, $config->getCompiler());
        $this->assertInstanceOf(TemplateCompilerInterface::class, $config->getCompiler());

        $this->assertInstanceOf(TemplateReaderInterface::class, $config->getReader());
        $this->assertInstanceOf(TemplateLoaderInterface::class, $config->getLoader());
    }
}
