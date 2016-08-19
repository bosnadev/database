<?php

use Illuminate\Container\Container;
use Bosnadev\Database\PostgresConnection;
use Bosnadev\Database\Connectors\ConnectionFactory;

class ConnectionFactoryBaseTest extends BaseTestCase
{
    public function testMakeCallsCreateConnection()
    {
        $pgConfig = [ 'driver' => 'pgsql', 'prefix' => 'prefix', 'database' => 'database', 'name' => 'foo' ];
        $pdo      = new DatabaseConnectionFactoryPDOStub;


        $factory = Mockery::mock(ConnectionFactory::class, [ new Container() ])->makePartial();
        $factory->shouldAllowMockingProtectedMethods();
        $conn    = $factory->createConnection('pgsql', $pdo, 'database', 'prefix', $pgConfig);

        $this->assertInstanceOf(PostgresConnection::class, $conn);
    }
}

class DatabaseConnectionFactoryPDOStub extends PDO
{
    public function __construct()
    {
    }
}
