<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Collection;

use Laventure\Utils\Parameter\Parameter;

/**
 * EnvironmentCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Utils
 */
class EnvironmentCollection extends Parameter implements EnvironmentCollectionInterface
{
    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        parent::__construct($params ?: $_ENV);
    }




    /**
     * @param string $env
     * @return bool
    */
    public function put(string $env): bool
    {
        $matches = $this->matchEnv($env);

        if (!empty($matches)) {
            [$key, $value] = $this->envAsArray($matches[0]);
            $this->set($key, $value);
            return true;
        }
        return false;
    }





    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function set($id, $value): static
    {
        putenv("$id=$value");

        parent::set($id, $value);

        $_SERVER[$id] = $value;

        return $this;
    }





    /**
     * @param string $env
     * @return array
    */
    public function matchEnv(string $env): array
    {
        preg_match('#^(?=[A-Z])(.*)=(.*)$#', $env, $matches);

        return $matches;
    }





    /**
     * @inheritdoc
    */
    public function remove($id): bool
    {
        unset($_SERVER[$id]);

        return parent::remove($id);
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
}
