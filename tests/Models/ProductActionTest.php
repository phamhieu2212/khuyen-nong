<?php namespace Tests\Models;

use App\Models\ProductAction;
use Tests\TestCase;

class ProductActionTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\ProductAction $productAction */
        $productAction = new ProductAction();
        $this->assertNotNull($productAction);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\ProductAction $productAction */
        $productActionModel = new ProductAction();

        $productActionData = factory(ProductAction::class)->make();
        foreach( $productActionData->toFillableArray() as $key => $value ) {
            $productActionModel->$key = $value;
        }
        $productActionModel->save();

        $this->assertNotNull(ProductAction::find($productActionModel->id));
    }

}
