<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Config\Resolver;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Configuration\Resolver\ConfigurationResolverInterface;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\PdoDsnBuilder;


/**
 * PdoConfigurationResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Config\Resolver
 */
class PdoConfigurationResolver implements ConfigurationResolverInterface
{


     /**
      * @var string|null
     */
     protected ?string $driver;



     /**
      * @param string|null $driver
     */
     public function __construct(?string $driver = null)
     {
         $this->withDefaultDriver($driver);
     }



     /**
      * @param string $driver
      * @return $this
     */
     public function withDefaultDriver(string $driver): static
     {
         $this->driver = $driver;

         return $this;
     }




     /**
      * @inheritDoc
     */
     public function resolve(ConfigurationInterface $config): ConfigurationInterface
     {
          $config['dsn'] = $this->resolveDsn($config);

          return $config;
     }



    /**
     * @param ConfigurationInterface $config
     * @return string
    */
    private function resolveDsn(ConfigurationInterface $config): string
    {
        $driver = $config->get('driver', $this->driver);

        if ($config->has('dsn')) {
            $dsn = $config['dsn'];
            if (is_array($dsn)) {
                return $this->buildDsn($driver, $dsn);
            }
            return $dsn;
        }

        return $this->buildDsn($driver, $this->getDefaultParams($config));
    }




    /**
     * @param string $driver
     * @param array $params
     * @return string
    */
    private function buildDsn(string $driver, array $params): string
    {
        return strval(PdoDsnBuilder::create($driver, $params));
    }



    /**
     * @param ConfigurationInterface $config
     * @return array
    */
    private function getDefaultParams(ConfigurationInterface $config): array
    {
        return [
            'host'     => $config->host(),
            'port'     => $config->port(),
            'dbname'   => $config->database(),
            'charset'  => $config->get('charset', 'utf8'),
            'username' => $config->username(),
            'password' => $config->password()
        ];
    }
}