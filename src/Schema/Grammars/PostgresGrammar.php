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
     * @param mixed $value
     * @return mixed|string
     */
    protected function getDefaultValue($value)
    {
        if ($value instanceof Expression) {
            return $value;
        }

        if (is_bool($value)) {
            return "'".intval($value)."'";
        }

        if ($this->isUuid($value)) {
            return strval($value);
        }

        return "'".strval($value)."'";
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
