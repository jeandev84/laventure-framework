<?php

declare(strict_types=1);

namespace Laventure\Dotenv;

use Laventure\Dotenv\Contract\EnvironmentInterface;

/**
 * Environment
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Utils
 */
class Environment implements EnvironmentInterface
{
    private static $instance;


    /**
     * @param string $env
     * @return bool
    */
    public function put(string $env): bool
    {
        preg_match('#^(?=[A-Z])(.*)=(.*)$#', $env, $matches);

        if (!empty($matches)) {
            putenv($env);
            [$key, $value] = $this->envAsArray($matches[0]);
            $_SERVER[$key] = $_ENV[$key] = $value;
            return true;
        }
        return false;
    }




    /**
     * @inheritDoc
    */
    public function has(string $key): bool
    {
        return isset($_ENV[$key]);
    }





    /**
     * @param string $key
     * @return void
    */
    public function remove(string $key): void
    {
        unset($_ENV[$key], $_SERVER[$key]);
    }




    /**
     * @inheritdoc
    */
    public function empty(): bool
    {
        return empty($_ENV);
    }




    /**
     * @return array
    */
    public function all(): array
    {
        return $_ENV;
    }






    /**
     * @param string $env
     *
     * @return array
    */
    private function envAsArray(string $env): array
    {
        $parameters = str_replace(' ', '', trim($env));

        return explode("=", $parameters, 2);
    }




    /**
     * @inheritDoc
    */
    public function clear(): void
    {
        if (!empty($_ENV)) {
            foreach (array_keys($_ENV) as $name) {
                $this->remove($name);
            }
        }
    }



    public static function getInstance(): static
    {
        if (! static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }
}
