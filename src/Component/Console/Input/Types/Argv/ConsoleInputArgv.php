<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Types\Argv;

/**
 * ConsoleInputArgv
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Input\Argv
*/
class ConsoleInputArgv extends InputArgv
{
    /**
     * @param array $tokens
    */
    public function __construct(array $tokens = [])
    {
        parent::__construct($tokens ?: $_SERVER['argv']);
    }



    /**
     * @inheritDoc
    */
    public function count(): int
    {
        return $_SERVER['argc'] ?? 0;
    }





    /**
     * Example:
     * $ php console
     *       database:migrations:migrate
     *       create_new_users_table -table=users --refresh=users -t --test --foo
     *
     * @param $token
     * @return void
    */
    protected function parseToken($token): void
    {
        if (preg_match("/^(.+)=(.+)$/", $token)) {
            $this->parseTokenAttributes($token);
        } elseif (preg_match('#^--([^=]+)$#i', $token, $flags)) {
            $this->setOption($flags[1], true);
        } elseif (preg_match('#^-([^=]+)$#i', $token, $flags)) {
            $this->shortcutOption($flags[1], true);
            $this->setOption($flags[1], true);
        } else {
            $this->addArgument($token);
        }
    }



    /**
     * @param $token
     * @return void
    */
    private function parseTokenAttributes($token): void
    {
        if (preg_match('#^--([^=]+)=(.*)$#i', $token, $options)) {
            $this->setOption($options[1], $options[2]);
        } elseif (preg_match('#^-([^=]+)=(.*)$#i', $token, $options)) {
            $this->shortcutOption($options[1], $options[2]);
            $this->setOption($options[1], $options[2]);
        } else {
            list($name, $value) = explode('=', $token, 2);
            $this->setArgument($name, $value);
        }
    }
}
