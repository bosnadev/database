<?php namespace Bosnadev\Database\Traits;

use Rhumsaa\Uuid\Uuid;

/**
 * Class UuidTrait
 * @package Bosnadev\Database\src\Traits
 */
trait UuidTrait {

    /**
     *  This method will override model's boot method
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->provideUuidKey($model);
        });
    }

    /**
     * Provide a UUID
     *
     * @param $model
     */
    protected function provideUuidKey($model) {
        // provide a UUID only if increment is disabled
        if($model->incrementing === false) {
            $key = $model->getKeyName();

            if(empty($model->$key))
                $model->$key = (string)Uuid::uuid4();
        }
    }
}