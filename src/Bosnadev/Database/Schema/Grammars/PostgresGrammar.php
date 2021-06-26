<?php

namespace Bosnadev\Database\Schema\Grammars;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Blueprint as BaseBlueprint;
use Bosnadev\Database\Schema\Blueprint;

/**
 * Class PostgresGrammar
 *
 * Available Column Type supported dynamically:
 * hstore, uuid, jsonb, point, line,
 * path, box, polygon, circle,
 * money, int4range, int8range, numrange,
 * tsrange, tstzrange, daterange, tsvector
 *
 * @package Bosnadev\Database\Schema\Grammars
 */
class PostgresGrammar extends \Illuminate\Database\Schema\Grammars\PostgresGrammar
{
     /**
     * Check if the type is uuid, use internal guid
     *
     * @param  string $type
     * @return \Doctrine\DBAL\Types\Type
     */
    protected function getDoctrineColumnType($type)
    {
        if($type === 'uuid') {
            $type = 'guid';
        }

        return parent::getDoctrineColumnType($type);
    }

    /**
     * Handle dynamic method calls.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if(substr($method, 0, 4) === 'type') {
            $type = substr($method, 4, strlen($method) - 4);

            return lcfirst($type);
        }
    }

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
     * Create the column definition for an IPv4 or IPv6 address.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeIpAddress(Fluent $column)
    {
        return 'inet';
    }

    /**
     * Create the column definition for a CIDR notation-style netmask.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeNetmask(Fluent $column)
    {
        return 'cidr';
    }

    /**
     * Create the column definition for a MAC address.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeMacAddress(Fluent $column)
    {
        return 'macaddr';
    }

    /**
     * Create the column definition for a line segment represented by two points (x1, y1), (x2, y2).
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeLineSegment(Fluent $column)
    {
        return 'lseg';
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
    
    /**
     * Compile a gist index key command.
     *
     * @param  \Bosnadev\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileGist(Blueprint $blueprint, Fluent $command)
    {
        $columns = $this->columnize($command->columns);

        return sprintf('CREATE INDEX %s ON %s USING GIST(%s)', $command->index, $this->wrapTable($blueprint), $columns);
    }

    /**
     * Compile create table query.
     *
     * @param  Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @return string
     */
    public function compileCreate(BaseBlueprint $blueprint, Fluent $command)
    {
        $sql = parent::compileCreate($blueprint, $command);

        if (isset($blueprint->inherits)) {
            $sql .= ' INHERITS ("'.$blueprint->inherits.'")';
        }
        return $sql;
    }
}
