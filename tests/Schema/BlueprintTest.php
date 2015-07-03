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
}
