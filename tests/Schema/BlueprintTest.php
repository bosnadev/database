<?php namespace Schema;

use BaseTestCase;
use Mockery;
use Bosnadev\Database\Schema\Blueprint;

class BlueprintTest extends BaseTestCase
{
    protected $blueprint;

    public function setUp()
    {
        parent::setUp();

        $this->blueprint = Mockery::mock(Blueprint::class)
            ->makePartial()->shouldAllowMockingProtectedMethods();
    }

    public function testGinIndex()
    {
        $this->blueprint
            ->shouldReceive('indexCommand')
            ->with('gin', 'col', 'myName');

        $this->blueprint->gin('col', 'myName');
    }

    public function testCharacter()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('character', 'col', 14);

        $this->blueprint->character('col', 14);
    }

    public function testHstore()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('hstore', 'col');

        $this->blueprint->hstore('col');
    }

    public function testUuid()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('uuid', 'col');

        $this->blueprint->uuid('col');
    }

    public function testJsonb()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('jsonb', 'col');

        $this->blueprint->jsonb('col');
    }

    public function testInt4range()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('int4range', 'col');

        $this->blueprint->int4range('col');
    }

    public function testInt8range()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('int8range', 'col');

        $this->blueprint->int8range('col');
    }

    public function testNumrange()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('numrange', 'col');

        $this->blueprint->numrange('col');
    }

    public function testTsrange()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('tsrange', 'col');

        $this->blueprint->tsrange('col');
    }

    public function testTstzrange()
    {
        $this->blueprint
            ->shouldReceive('addColumn')
            ->with('tstzrange', 'col');

        $this->blueprint->tstzrange('col');
    }
}
