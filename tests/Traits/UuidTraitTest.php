<?php namespace Traits;

use BaseTestCase;
use Bosnadev\Database\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use RuntimeException;

class UuidTraitTest extends BaseTestCase
{
    public function testTraitIsBooted()
    {
        $model = new UuidBootingModelStub();
        $this->assertTrue($model::$uuidBooted);
    }

    /**
     * @expectedException RuntimeException
     */
    public function testRequiredIncrementingFalse()
    {
        $model = new UuidAssignsUuidStub();
        $model->_provideUuidKey();
    }

    public function testUuidAssignsUuid()
    {
        $model = new UuidAssignsUuidStub2();

        $model->_provideUuidKey();

        $this->assertEquals(4, substr_count($model->id, '-'));
    }
}

class UuidBootingModelStub extends Model
{
    use UuidTrait;

    public static $uuidBooted = false;

    public static function bootUuidTrait()
    {
        static::$uuidBooted = true;
    }
}

class UuidAssignsUuidStub extends Model
{
    use UuidTrait;

    public $timestamps = false;
    public $incrementing = true;

    public function _provideUuidKey()
    {
        $this->provideUuidKey($this);
    }
}

class UuidAssignsUuidStub2 extends UuidAssignsUuidStub
{
    public $incrementing = false;
}
