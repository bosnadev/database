<?php namespace Bosnadev\Foundation\Database\Connectors;

use PDO;
use Illuminate\Container\Container;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\SqlServerConnection;
use Bosnadev\Foundation\Database\PostgresConnection;

/**
 * Class ConnectionFactory
 * @package Bosnadev\Foundation\Database\Connectors
 */
class ConnectionFactory extends \Illuminate\Database\Connectors\ConnectionFactory {

    /**
     * @param string $driver
     * @param PDO $connection
     * @param string $database
     * @param string $prefix
     * @param array $config
     * @return PostgresConnection|MySqlConnection|SQLiteConnection|SqlServerConnection|mixed|object
     * @throws \InvalidArgumentException
     */
    protected function createConnection($driver, PDO $connection, $database, $prefix = '', array $config = array())
    {
        if ($this->container->bound($key = "db.connection.{$driver}"))
        {
            return $this->container->make($key, array($connection, $database, $prefix, $config));
        }

        switch ($driver)
        {
            case 'mysql':
                return new MySqlConnection($connection, $database, $prefix, $config);

            case 'pgsql':
                return new PostgresConnection($connection, $database, $prefix, $config);

            case 'sqlite':
                return new SQLiteConnection($connection, $database, $prefix, $config);

            case 'sqlsrv':
                return new SqlServerConnection($connection, $database, $prefix, $config);
        }

        throw new \InvalidArgumentException("Unsupported driver [$driver]");
    }

} 