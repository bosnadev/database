<?php namespace Bosnadev\Foundation\Database\Query\Grammars;

/**
 * Class PostgresGrammar
 * @package Bosnadev\Foundation\Database\Query\Grammars
 */
class PostgresGrammar extends \Illuminate\Database\Query\Grammars\PostgresGrammar {

    /**
     * @param string $value
     * @return string
     */
    protected function wrapValue($value)
    {
        if ($value === '*') return $value;

        // If quering hstore
        if( preg_match('/\[(.*?)\]/', $value, $match) ) {
            return (string) str_replace(array( '[', ']' ), '', $match[1]);
        }

        return '"'.str_replace('"', '""', $value).'"';
    }
} 