<?php namespace Schema;

use BaseTestCase;
use Mockery;
use Bosnadev\Database\PostgresConnection;
use Bosnadev\Database\Schema\Builder;
use Bosnadev\Database\Schema\Blueprint;

class BuilderTest extends BaseTestCase
{
    public function testReturnsCorrectBlueprint()
    {
        $connection = Mockery::mock(PostgresConnection::class);
        $connection->shouldReceive('getSchemaGrammar')->once()->andReturn(null);

        $mock = Mockery::mock(Builder::class, [ $connection ]);
        $mock->makePartial()->shouldAllowMockingProtectedMethods();
        $blueprint = $mock->createBlueprint('test', function () {});

        $this->assertInstanceOf(Blueprint::class, $blueprint);
    }
}
