<?php namespace Bosnadev\Database;

/**
 * Class Connection
 * @package Bosnadev\Database
 */
class Connection extends \Illuminate\Database\Connection {

    /**
     * Get a schema builder instance for the connection.
     *
     * @return Schema\Builder
     */
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) { $this->useDefaultSchemaGrammar(); }

        return new Schema\Builder($this);
    }
}
