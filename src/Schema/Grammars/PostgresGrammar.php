<?php namespace Bosnadev\Database\Schema\Grammars;

use Illuminate\Support\Fluent;
use Bosnadev\Database\Schema\Blueprint;

/**
 * Class PostgresGrammar
 * @package Bosnadev\Database\Schema\Grammars
 */
class PostgresGrammar extends \Illuminate\Database\Schema\Grammars\PostgresGrammar
{
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
     * Create the column definition for a hstore type.
     *
     * @param Fluent $column
     * @return string
     */
    protected function typeHstore(Fluent $column)
    {
        return "hstore";
    }

    /**
     * Create the column definition for a uuid type.
     *
     * @param Fluent $column
     * @return string
     */
    protected function typeUuid(Fluent $column)
    {
        return "uuid";
    }

    /**
     * Create the column definition for a jsonb type.
     *
     * @param Fluent $column
     * @return string
     */
    protected function typeJsonb(Fluent $column)
    {
        return "jsonb";
    }

    /**
     * Create the column definition for an int4range type.
     *
     * @param Fluent $column
     *
     * @return string
     */
    protected function typeInt4range(Fluent $column)
    {
        return "int4range";
    }

    /**
     * Create the column definition for an int8range type.
     *
     * @param Fluent $column
     *
     * @return string
     */
    protected function typeInt8range(Fluent $column)
    {
        return "int8range";
    }

    /**
     * Create the column definition for an numrange type.
     *
     * @param Fluent $column
     *
     * @return string
     */
    protected function typeNumrange(Fluent $column)
    {
        return "numrange";
    }

    /**
     * Create the column definition for an tsrange type.
     *
     * @param Fluent $column
     *
     * @return string
     */
    protected function typeTsrange(Fluent $column)
    {
        return "tsrange";
    }

    /**
     * Create the column definition for an tstzrange type.
     *
     * @param Fluent $column
     *
     * @return string
     */
    protected function typeTstzrange(Fluent $column)
    {
        return "tstzrange";
    }

    /**
     * Create the column definition for an daterange type.
     *
     * @param Fluent $column
     *
     * @return string
     */
    protected function typeDaterange(Fluent $column)
    {
        return "daterange";
    }

    /**
     * @param mixed $value
     * @return mixed|string
     */
    protected function getDefaultValue($value)
    {
        if($this->isUuid($value)) return strval($value);

        return parent::getDefaultValue($value);
    }

    /**
     * Check if string matches on of uuid_generate functions
     *
     * @param $value
     * @return int
     */
    protected function isUuid($value)
    {
        return preg_match('/^uuid_generate_v/', $value);
    }

    /**
     * Compile a gin index key command.
     *
     * @param  \Bosnadev\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileGin(Blueprint $blueprint, Fluent $command)
    {
        $columns = $this->columnize($command->columns);

        return sprintf('CREATE INDEX %s ON %s USING GIN(%s)', $command->index, $this->wrapTable($blueprint), $columns);
    }
}
