<?php namespace Bosnadev\Database\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use RuntimeException;

/**
 * Class UuidTrait
 * @package Bosnadev\Database\src\Traits
 */
trait UuidTrait
{
    /**
     *  This method will override model's boot method
     *
     * @return void
     */
    protected static function bootUuidTrait()
    {
        static::creating(function (Model $model) {
            $model->provideUuidKey($model);
        });
    }

    /**
     * Provide a UUID
     *
     * @param $model
     */
    protected function provideUuidKey($model)
    {
        // provide a UUID only if increment is disabled
        if ($model->incrementing === false) {
            $key = $model->getKeyName();

            if (empty($model->$key)) {
                $model->$key = (string)Uuid::uuid4();
            }
        } else {
            throw new RuntimeException(
              sprintf('$incrementing must be false on class "%s" to support uuid', get_class($this))
            );
        }
    }
}
