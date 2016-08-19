<?php

namespace Bosnadev\Database\Connectors;

use PDO;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Database\SqlServerConnection;
use Bosnadev\Database\PostgresConnection;

/**
 * Class ConnectionFactory
 * @package Bosnadev\Database\Connectors
 */
class ConnectionFactory extends \Illuminate\Database\Connectors\ConnectionFactory
{
    /**
     * @param string $driver
     * @param PDO $connection
     * @param string $database
     * @param string $prefix
     * @param array $config
     * @return PostgresConnection|MySqlConnection|SQLiteConnection|SqlServerConnection|mixed|object
     * @throws \InvalidArgumentException
     */
    protected function createConnection($driver, $connection, $database, $prefix = '', array $config = array())
    {
        if ($this->container->bound($key = "db.connection.{$driver}")) {
            return $this->container->make($key, array($connection, $database, $prefix, $config));
        }

        if ($driver === 'pgsql') {
            return new PostgresConnection($connection, $database, $prefix, $config);
        }

        return parent::createConnection($driver, $connection, $database, $prefix, $config);
    }
}
