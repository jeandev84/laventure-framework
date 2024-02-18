<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Configuration;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;

/**
 * DatabaseConfiguration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\Configuration
*/
class DatabaseConfigurationManager extends Configuration
{
    /**
     * @return string
    */
    public function getConnection(): string
    {
        return $this->get('connection');
    }


    /**
     * @return string
    */
    public function getExtension(): string
    {
        return $this->get('extension');
    }




    /**
     * @return array
    */
    public function getCredentials(): array
    {
        return $this->get('credentials');
    }





    /**
     * @return Configuration
    */
    public function getConfiguration(): Configuration
    {
        $config = new Configuration($this->getCredentials());

        switch ($this->getExtension()):
            case 'pdo': $config['dsn'] = $this->resolvePdoDsn($config); break;
        endswitch;

        return $config;
    }





    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    private function resolvePdoDsn(ConfigurationInterface $config): string
    {
        $driver = $config->get('driver');

        if ($config->has('dsn')) {
            $dsn = $config['dsn'];
            if (is_array($dsn)) {
                return $this->buildDsn($driver, $dsn);
            }
            return $dsn;
        }

        return $this->buildDsn($driver, [
            [
                'host'     => $config->host(),
                'port'     => $config->port(),
                'dbname'   => $config->database(),
                'charset'  => $config->get('charset', 'utf8'),
                'username' => $config->username(),
                'password' => $config->password()
            ]
        ]);
    }





    /**
     * @param string $driver
     * @param array $params
     * @return string
    */
    private function buildDsn(string $driver, array $params): string
    {
        return PdoDsnBuilder::create($driver, $params);
    }
}
