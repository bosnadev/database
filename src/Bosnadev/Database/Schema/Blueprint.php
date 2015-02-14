<?php namespace Bosnadev\Database\Schema;

/**
 * Class Blueprint
 * @package Bosnadev\Database\Schema
 */
class Blueprint extends \Illuminate\Database\Schema\Blueprint
{

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
} 