<?php

use Bosnadev\Database\PostgresConnection;
use Bosnadev\Database\Schema\Blueprint;
use Bosnadev\Database\Schema\Grammars\PostgresGrammar;

class PostgresGrammarBaseTest extends BaseTestCase
{
    public function testAddingGinIndex()
    {
        $blueprint = new Blueprint('test');
        $blueprint->gin('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertContains('CREATE INDEX', $statements[0]);
        $this->assertContains('GIN("foo")', $statements[0]);
    }

    public function testAddingCharacter()
    {
        $blueprint = new Blueprint('test');
        $blueprint->character('foo', 14);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" character(14)', $statements[0]);
    }

    public function testAddingHstore()
    {
        $blueprint = new Blueprint('test');
        $blueprint->hstore('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" hstore', $statements[0]);
    }

    public function testAddingUuid()
    {
        $blueprint = new Blueprint('test');
        $blueprint->uuid('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" uuid', $statements[0]);
    }

    public function testAddingJsonb()
    {
        $blueprint = new Blueprint('test');
        $blueprint->jsonb('foo');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" jsonb', $statements[0]);
    }

    public function testAddingInt4range()
    {
        $blueprint = new Blueprint('test');
        $blueprint->int4range('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" int4range', $statements[0]);
    }

    public function testAddingInt8range()
    {
        $blueprint = new Blueprint('test');
        $blueprint->int8range('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" int8range', $statements[0]);
    }

    public function testAddingNumrange()
    {
        $blueprint = new Blueprint('test');
        $blueprint->numrange('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" numrange', $statements[0]);
    }

    public function testAddingTsrange()
    {
        $blueprint = new Blueprint('test');
        $blueprint->tsrange('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" tsrange', $statements[0]);
    }

    public function testAddingTstzrange()
    {
        $blueprint = new Blueprint('test');
        $blueprint->tstzrange('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" tstzrange', $statements[0]);
    }

    public function testAddingDatarange()
    {
        $blueprint = new Blueprint('test');
        $blueprint->daterange('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );

        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" daterange', $statements[0]);
    }
    
    public function testAddingTsvector()
    {
        $blueprint = new Blueprint('test');
        $blueprint->tsvector('foo');
        $statements = $blueprint->toSql(
            $this->getConnection(),
            $this->getGrammar()
        );
        
        $this->assertEquals(1, count($statements));
        $this->assertContains('alter table', $statements[0]);
        $this->assertContains('add column "foo" tsvector', $statements[0]);
    }

    /**
     * @return PostgresConnection
     */
    protected function getConnection()
    {
        return Mockery::mock(PostgresConnection::class);
    }

    protected function getGrammar()
    {
        return new PostgresGrammar();
    }
}
