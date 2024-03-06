<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Config;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Name\ConnectionName;
use Laventure\Utils\Parameter\Parameter;

/**
 * ManagerConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\Definition
*/
class ManagerConfiguration extends Parameter implements ManagerConfigurationInterface
{
    /**
     * @inheritdoc
    */
    public function getConnectionType(): string
    {
        return $this->required('connection');
    }





    /**
     * @inheritdoc
    */
    public function credentials(): ConfigurationInterface
    {
        $credentials = $this->credentialsByType();

        if ($this->hasSQLiteType()) {
           $credentials['database'] = $this->path($credentials['database']);
        }

        return new Configuration($credentials);
    }





    /**
     * @return array
    */
    public function connections(): array
    {
        return $this->required('connections');
    }





    /**
     * @param $path
     * @return string
    */
    public function path($path): string
    {
        if (!$basePath = $this->basePath()) {
             return $path;
        }

        return join(DIRECTORY_SEPARATOR, [
            rtrim($basePath),
            trim($path, '\\/')
        ]);
    }





    /**
     * @return string|null
    */
    public function basePath(): ?string
    {
        return $this->get('basePath');
    }





    /**
     * @return array
    */
    private function credentialsByType(): array
    {
        return $this->connections()[$this->getConnectionType()];
    }





    /**
     * @return bool
    */
    private function hasSQLiteType(): bool
    {
        return $this->getConnectionType() === ConnectionName::Sqlite;
    }
}
