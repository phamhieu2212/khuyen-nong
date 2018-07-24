<?php namespace Tests\Models;

use App\Models\Htx;
use Tests\TestCase;

class HtxTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Htx $htx */
        $htx = new Htx();
        $this->assertNotNull($htx);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Htx $htx */
        $htxModel = new Htx();

        $htxData = factory(Htx::class)->make();
        foreach( $htxData->toFillableArray() as $key => $value ) {
            $htxModel->$key = $value;
        }
        $htxModel->save();

        $this->assertNotNull(Htx::find($htxModel->id));
    }

}
