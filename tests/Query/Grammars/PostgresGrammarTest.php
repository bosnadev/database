<?php namespace Query\Grammars;

use BaseTestCase;
use Bosnadev\Database\Query\Grammars\PostgresGrammar;
use Mockery;

class PostgresGrammarTest extends BaseTestCase {
	public function testWrapValue() {
		$grammar = Mockery::mock( PostgresGrammar::class )->makePartial();

		$this->assertEquals( 'a => b', $grammar->wrapValue( '[a => b]' ) );
	}
}
