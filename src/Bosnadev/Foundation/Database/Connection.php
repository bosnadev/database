<?php namespace Bosnadev\Foundation\Database;

/**
 * Class Connection
 * @package Bosnadev\Foundation\Database
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

    /**
     *
     */
    public function useDefaultSchemaGrammar()
    {
        $this->schemaGrammar = $this->getDefaultSchemaGrammar();
    }

}