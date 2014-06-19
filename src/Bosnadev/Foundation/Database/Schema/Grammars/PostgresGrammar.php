<?php namespace Bosnadev\Foundation\Database\Schema\Grammars;

use Illuminate\Support\Fluent;

/**
 * Class PostgresGrammar
 * @package Bosnadev\Foundation\Database\Schema\Grammars
 */
class PostgresGrammar extends \Illuminate\Database\Schema\Grammars\PostgresGrammar {


    /**
     * Create the column definition for a character type.
     *
     * @param Fluent $column
     * @return string
     */
    protected function typeCharacter(Fluent $column)
    {
        return "character({$column->length})";
    }

    /**
     * @param Fluent $column
     * @return string
     */
    protected function typeHstore(Fluent $column) {
        return "hstore";
    }

    /**
     * @param Fluent $column
     * @return string
     */
    protected function typeUuid(Fluent $column) {
        return "uuid";
    }

    /**
     * @param mixed $value
     * @return mixed|string
     */
    protected function getDefaultValue($value)
    {
        if ($value instanceof Expression) return $value;

        if (is_bool($value)) return "'".intval($value)."'";

        if( $this->isUuid( $value ) ) return strval($value);

        return "'".strval($value)."'";
    }

    /**
     * Check if string matches on of uuid_generate functions
     *
     * @param $value
     * @return int
     */
    protected function isUuid($value) {
        return preg_match( '/^uuid_generate_v/', $value );
    }

}