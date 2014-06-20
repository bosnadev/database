<?php namespace Bosnadev\Foundation\Database;

/**
 * Class PostgresConnection
 *
 * @package Bosnadev\Foundation\Database
 */
class PostgresConnection extends Connection {

    /**
     * Get the default query grammar instance.
     *
     * @return \Illuminate\Database\Grammar
     */
    protected function getDefaultQueryGrammar()
    {
        return $this->withTablePrefix(new Query\Grammars\PostgresGrammar);
    }


    /**
     * Get the default schema grammar instance.
     *
     * @return \Illuminate\Database\Grammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new Schema\Grammars\PostgresGrammar);
    }


    /**
     * Get the default post processor instance.
     *
     * @return \Illuminate\Database\Query\Processors\PostgresProcessor
     */
    protected function getDefaultPostProcessor()
    {
        return new \Illuminate\Database\Query\Processors\PostgresProcessor;
    }

} 