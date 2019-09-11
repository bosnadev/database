<?php

namespace Bosnadev\Database\Schema;

/**
 * Class Blueprint
 * @package Bosnadev\Database\Schema
 */
class Blueprint extends \Illuminate\Database\Schema\Blueprint
{
    /**
     * Inherited table name
     * @var string
     */
    public $inherits;

    /**
     * Specify table inheritance.
     *
     * @param  string $table
     * @return void
     */
    public function inherits($table)
    {
        $this->inherits = $table;
    }

    /**
     * Add the index commands fluently specified on columns.
     *
     * @return void
     */
    protected function addFluentIndexes()
    {
        foreach ($this->columns as $column) {
            foreach (array('primary', 'unique', 'index', 'gin', 'gist') as $index) {
                // If the index has been specified on the given column, but is simply
                // equal to "true" (boolean), no name has been specified for this
                // index, so we will simply call the index methods without one.
                if ($column->$index === true) {
                    $this->$index($column->name);

                    continue 2;
                }

                // If the index has been specified on the column and it is something
                // other than boolean true, we will assume a name was provided on
                // the index specification, and pass in the name to the method.
                elseif (isset($column->$index)) {
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
     * Specify a gist index for the table.
     *
     * @param  string|array  $columns
     * @param  string  $name
     * @return \Illuminate\Support\Fluent
     */
    public function gist($columns, $name = null)
    {
        return $this->indexCommand('gist', $columns, $name);
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
    public function hstore($column)
    {
        return $this->addColumn('hstore', $column);
    }

    /**
     * Create a new netmask (CIDR-notation) (cidr) column on the table.
     *
     * @param  string  $column
     * @return \Illuminate\Support\Fluent
     */
    public function netmask($column)
    {
        return $this->addColumn('netmask', $column);
    }

    /**
     * Create a new line column on the table.
     *
     * @param  string  $column
     * @return \Illuminate\Support\Fluent
     */
    public function line($column)
    {
        return $this->addColumn('line', $column);
    }

    /**
     * Create a new line segment (lseg) column on the table.
     *
     * @param  string  $column
     * @return \Illuminate\Support\Fluent
     */
    public function lineSegment($column)
    {
        return $this->addColumn('lineSegment', $column);
    }

    /**
     * Create a new path column on the table.
     *
     * @param  string  $column
     * @return \Illuminate\Support\Fluent
     */
    public function path($column)
    {
        return $this->addColumn('path', $column);
    }

    /**
     * Create a new box column on the table.
     *
     * @param  string  $column
     * @return \Illuminate\Support\Fluent
     */
    public function box($column)
    {
        return $this->addColumn('box', $column);
    }

    /**
     * Create a new circle column on the table.
     *
     * @param  string  $column
     * @return \Illuminate\Support\Fluent
     */
    public function circle($column)
    {
        return $this->addColumn('circle', $column);
    }

    /**
     * Create a new money column on the table.
     *
     * @param  string  $column
     * @return \Illuminate\Support\Fluent
     */
    public function money($column)
    {
        return $this->addColumn('money', $column);
    }

    /**
     * Create a new int4range column on the table.
     *
     * @param string $column
     *
     * @return \Illuminate\Support\Fluent
     */
    public function int4range($column)
    {
        return $this->addColumn('int4range', $column);
    }

    /**
     * Create a new int8range column on the table.
     *
     * @param string $column
     *
     * @return \Illuminate\Support\Fluent
     */
    public function int8range($column)
    {
        return $this->addColumn('int8range', $column);
    }

    /**
     * Create a new numrange column on the table.
     *
     * @param string $column
     *
     * @return \Illuminate\Support\Fluent
     */
    public function numrange($column)
    {
        return $this->addColumn('numrange', $column);
    }

    /**
     * Create a new tsrange column on the table.
     *
     * @param string $column
     *
     * @return \Illuminate\Support\Fluent
     */
    public function tsrange($column)
    {
        return $this->addColumn('tsrange', $column);
    }

    /**
     * Create a new tstzrange column on the table.
     *
     * @param string $column
     *
     * @return \Illuminate\Support\Fluent
     */
    public function tstzrange($column)
    {
        return $this->addColumn('tstzrange', $column);
    }

    /**
     * Create a new daterange column on the table.
     *
     * @param $column
     *
     * @return \Illuminate\Support\Fluent
     */
    public function daterange($column)
    {
        return $this->addColumn('daterange', $column);
    }
    
    /**
     * Create a new tsvector column on the table.
     *
     * @param $column
     *
     * @return \Illuminate\Support\Fluent
     */
    public function tsvector($column)
    {
        return $this->addColumn('tsvector', $column);
    }
}
