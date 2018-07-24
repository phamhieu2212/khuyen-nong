<?php namespace Tests\Models;

use App\Models\Farmer;
use Tests\TestCase;

class FarmerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Farmer $farmer */
        $farmer = new Farmer();
        $this->assertNotNull($farmer);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Farmer $farmer */
        $farmerModel = new Farmer();

        $farmerData = factory(Farmer::class)->make();
        foreach( $farmerData->toFillableArray() as $key => $value ) {
            $farmerModel->$key = $value;
        }
        $farmerModel->save();

        $this->assertNotNull(Farmer::find($farmerModel->id));
    }

}
