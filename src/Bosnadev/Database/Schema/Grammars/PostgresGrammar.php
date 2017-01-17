<?php

namespace Bosnadev\Database\Schema\Grammars;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Blueprint as BaseBlueprint;
use Bosnadev\Database\Schema\Blueprint;

/**
 * Class PostgresGrammar
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
     * Create the column definition for a 2D geometric point (x, y), x and y are floating-point numbers.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typePoint(Fluent $column)
    {
        return 'point';
    }

    /**
     * Create the column definition for a line represented as a standard linear equation Ax + By + C = 0.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeLine(Fluent $column)
    {
        return 'line';
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
     * Create the column definition for a path represented as a list of points (x1, y1), (x2, y2), ..., (xn, yn).
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typePath(Fluent $column)
    {
        return 'path';
    }

    /**
     * Create the column definition for a box represented by opposite corners of the box as points (x1, y1), (x2, y2).
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeBox(Fluent $column)
    {
        return 'box';
    }

    /**
     * Create the column definition for a polygon represented by a list of points (vertices of the polygon).
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typePolygon(Fluent $column)
    {
        return 'polygon';
    }

    /**
     * Create the column definition for a circle represented by a center point and a radius <(x, y), r>
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeCircle(Fluent $column)
    {
        return 'circle';
    }

    /**
     * Create the column definition for storing amounts of currency with a fixed fractional precision.
     *
     * This will store values in the range of: -92233720368547758.08 to +92233720368547758.07. (92 quadrillion).
     * Output is locale-sensitive, see lc_monetary setting of PostgreSQL instance/s.
     *
     * @param  \Illuminate\Support\Fluent  $column
     * @return string
     */
    protected function typeMoney(Fluent $column)
    {
        return 'money';
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
     * Create the column definition for a Text Search Vector type.
     *
     * @param Fluent $column
     *
     * @return string
     */
    protected function typeTsvector(Fluent $column)
    {
        return "tsvector";
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
