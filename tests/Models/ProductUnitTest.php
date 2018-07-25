<?php namespace Tests\Models;

use App\Models\ProductUnit;
use Tests\TestCase;

class ProductUnitTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ProductUnit $productUnit */
        $productUnit = new ProductUnit();
        $this->assertNotNull($productUnit);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ProductUnit $productUnit */
        $productUnitModel = new ProductUnit();

        $productUnitData = factory(ProductUnit::class)->make();
        foreach( $productUnitData->toFillableArray() as $key => $value ) {
            $productUnitModel->$key = $value;
        }
        $productUnitModel->save();

        $this->assertNotNull(ProductUnit::find($productUnitModel->id));
    }

}
