<?php

use Bosnadev\Database\PostgresConnection;
use Doctrine\DBAL\Driver\PDOPgSql\Driver;

class PostgresConnectionTest extends BaseTestCase
{
    public function testReturnsDoctrineDriver()
    {
        $conn = Mockery::mock(PostgresConnection::class)->makePartial();
        $this->assertInstanceOf(Driver::class, $conn->getDoctrineDriver());
    }
}
