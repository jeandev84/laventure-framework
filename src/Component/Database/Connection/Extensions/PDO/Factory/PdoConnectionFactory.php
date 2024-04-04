<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Factory;

use Laventure\Component\Database\Configuration\Contract\ConfigurationInterface;
use Laventure\Component\Database\Connection\Exception\ConnectionException;
use Laventure\Component\Database\Connection\Extensions\PDO\Dsn\Builder\PdoDsnBuilder;
use PDO;
use PDOException;

/**
 * PdoFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Factory
*/
class PdoConnectionFactory implements PdoConnectionFactoryInterface
{
    /**
     * @var array
    */
    protected array $options = [
        PDO::ATTR_PERSISTENT          => true,
        PDO::ATTR_EMULATE_PREPARES    => 0,
        PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION
    ];






    /**
     * @inheritDoc
    */
    public function makePdo(
        string $dsn,
        string $username = null,
        string $password = null,
        array $options = []
    ): PDO {
        try {
            $pdo = new PDO($dsn, $username, $password, $this->options);
            foreach ($options as $key => $value) {
                $pdo->setAttribute($key, $value);
            }
            return $pdo;
        } catch (PDOException $e) {
            throw new ConnectionException($e->getMessage());
        }
    }






    /**
     * @inheritDoc
    */
    public function makeConnection(ConfigurationInterface $config): PDO
    {
        return $this->makePdo(
            $config->required('dsn'),
            $config->getUsername(),
            $config->getPassword(),
            $config->getOptions()
        );
    }
}
