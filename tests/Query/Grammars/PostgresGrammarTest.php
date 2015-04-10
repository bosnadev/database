<?php namespace Query\Grammars;

use BaseTestCase;
use Bosnadev\Database\Query\Grammars\PostgresGrammar;
use Illuminate\Database\Query\Builder;
use Mockery;

class PostgresGrammarTest extends BaseTestCase
{
    public function testHstoreWrapValue()
    {
        $grammar = Mockery::mock(PostgresGrammar::class)->makePartial();

        $this->assertEquals('a => b', $grammar->wrapValue('[a => b]'));
    }

    public function testJsonWrapValue()
    {
        $grammar = Mockery::mock(PostgresGrammar::class)->makePartial();

        $this->assertEquals('"a"->\'b\'', $grammar->wrapValue("a->'b'"));
        $this->assertEquals('"a"->>\'b\'', $grammar->wrapValue("a->>'b'"));
        $this->assertEquals('"a"#>\'b\'', $grammar->wrapValue("a#>'b'"));
        $this->assertEquals('"a"#>>\'b\'', $grammar->wrapValue("a#>>'b'"));
    }

    public function testWhereNotNull()
    {
        $grammar = Mockery::mock(PostgresGrammar::class)->makePartial();
        $builder = Mockery::mock(Builder::class);
        $where = [
            'column' => "a->>'b'"
        ];

        $this->assertEquals('("a"->>\'b\') is not null', $grammar->whereNotNull($builder, $where));
    }

    public function testWhereNull()
    {
        $grammar = Mockery::mock(PostgresGrammar::class)->makePartial();
        $builder = Mockery::mock(Builder::class);
        $where = [
            'column' => "a->>'b'"
        ];

        $this->assertEquals('("a"->>\'b\') is null', $grammar->whereNull($builder, $where));
    }
}
