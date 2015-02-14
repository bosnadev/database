<?php namespace Bosnadev\Database\Schema;

/**
 * Class Blueprint
 * @package Bosnadev\Database\Schema
 */
class Blueprint extends \Illuminate\Database\Schema\Blueprint
{

    /**
     * Add the index commands fluently specified on columns.
     *
     * @return void
     */
    protected function addFluentIndexes()
    {
        foreach ($this->columns as $column)
        {
            foreach (array('primary', 'unique', 'index', 'gin') as $index)
            {
                // If the index has been specified on the given column, but is simply
                // equal to "true" (boolean), no name has been specified for this
                // index, so we will simply call the index methods without one.
                if ($column->$index === true)
                {
                    $this->$index($column->name);

                    continue 2;
                }

                // If the index has been specified on the column and it is something
                // other than boolean true, we will assume a name was provided on
                // the index specification, and pass in the name to the method.
                elseif (isset($column->$index))
                {
                    $this->$index($column->name, $column->$index);

                    continue 2;
                }
            }
        }
    }

    /**
     * Specify an index for the table.
     *
     * @param  string|array  $columns
     * @param  string  $name
     * @return \Illuminate\Support\Fluent
     */
    public function gin($columns, $name = null)
    {
        return $this->indexCommand('gin', $columns, $name);
    }

    /**
     * Create a new character column on the table.
     *
     * @param  string $column
     * @param  int $length
     * @return \Illuminate\Support\Fluent
     */
    public function character($column, $length = 255)
    {
        return $this->addColumn('character', $column, compact('length'));
    }

    /**
     * @param $column
     * @return \Illuminate\Support\Fluent
     */
    public function hstore($column) {
        return $this->addColumn('hstore', $column);
    }

    /**
     * @param $column
     * @return \Illuminate\Support\Fluent
     */
    public function uuid($column) {
        return $this->addColumn('uuid', $column);
    }

    /**
     * Create a new jsonb column on the table
     *
     * @param $column
     * @return \Illuminate\Support\Fluent
     */
    public function jsonb($column) {
        return $this->addColumn('jsonb', $column);
    }
} 