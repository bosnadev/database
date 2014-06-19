<?php namespace Bosnadev\Foundation\Database\Schema;

use Closure;
/**
 * Class Builder
 * @package Bosnadev\Foundation\Database\Schema
 */
class Builder extends \Illuminate\Database\Schema\Builder {

    /**
     * Create a new command set with a Closure.
     *
     * @param string $table
     * @param Closure $callback
     * @return Blueprint
     */
    protected function createBlueprint($table, Closure $callback = null)
    {
        return new Blueprint($table, $callback);
    }

}