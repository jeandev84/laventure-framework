<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

use Laventure\Component\Templating\Template\Compiler\Blocks\BlocksCompiler;
use Laventure\Component\Templating\Template\Compiler\Echos\EchosCompiler;
use Laventure\Component\Templating\Template\Compiler\Echos\EscapedEchoCompiler;
use Laventure\Component\Templating\Template\Compiler\Php\PhpCompiler;
use Laventure\Component\Templating\Template\Contract\TemplateInterface;
use Laventure\Component\Templating\Template\Factory\TemplateFactoryInterface;
use Laventure\Component\Templating\Template\Reader\TemplateReaderInterface;

/**
 * TemplateCompiler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler
*/
class TemplateCompiler implements TemplateCompilerInterface
{
    /**
     * @var CompilerInterface[]
    */
    protected array $compilers = [];


    /**
     * @param TemplateReaderInterface $reader
     * @param TemplateFactoryInterface $factory
    */
    public function __construct(
        protected TemplateReaderInterface $reader,
        protected TemplateFactoryInterface $factory
    ) {
        $this->addCompilers([
            new BlocksCompiler(),
            new EscapedEchoCompiler(),
            new EchosCompiler(),
            new PhpCompiler()
        ]);
    }




    /**
     * @param CompilerInterface $compiler
     *
     * @return $this
    */
    public function addCompiler(CompilerInterface $compiler): static
    {
        $this->compilers[] = $compiler;

        return $this;
    }




    /**
     * @param CompilerInterface[] $compilers
     *
     * @return $this
    */
    public function addCompilers(array $compilers): static
    {
        foreach ($compilers as $compiler) {
            $this->addCompiler($compiler);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getCompilers(): array
    {
        return $this->compilers;
    }





    /**
     * @inheritDoc
    */
    public function compile(TemplateInterface $template): CompiledTemplateInterface
    {
        $content = $this->includePaths($template);

        foreach ($this->getCompilers() as $compiler) {
            $content = $compiler->compile($content);
        }

        return new CompiledTemplate($template, $content);
    }





    /**
     * @param TemplateInterface $template
     *
     * @return string
    */
    private function includePaths(TemplateInterface $template): string
    {
        $pattern = '/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i';
        $content = $this->reader->withTemplate($template)->read();

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $value) {
            $included = $this->factory->createTemplate($value[2]);
            $content  = str_replace($value[0], $this->includePaths($included), $content);
        }

        return preg_replace('/{% ?(extends|include) ?\'?(.*?)\'? ?%}/i', '', $content);
    }
}
