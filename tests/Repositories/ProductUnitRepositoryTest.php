<?php namespace Tests\Repositories;

use App\Models\ProductUnit;
use Tests\TestCase;

class ProductUnitRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ProductUnitRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductUnitRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $productUnits = factory(ProductUnit::class, 3)->create();
        $productUnitIds = $productUnits->pluck('id')->toArray();

        /** @var  \App\Repositories\ProductUnitRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductUnitRepositoryInterface::class);
        $this->assertNotNull($repository);

        $productUnitsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ProductUnit::class, $productUnitsCheck[0]);

        $productUnitsCheck = $repository->getByIds($productUnitIds);
        $this->assertEquals(3, count($productUnitsCheck));
    }

    public function testFind()
    {
        $productUnits = factory(ProductUnit::class, 3)->create();
        $productUnitIds = $productUnits->pluck('id')->toArray();

        /** @var  \App\Repositories\ProductUnitRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductUnitRepositoryInterface::class);
        $this->assertNotNull($repository);

        $productUnitCheck = $repository->find($productUnitIds[0]);
        $this->assertEquals($productUnitIds[0], $productUnitCheck->id);
    }

    public function testCreate()
    {
        $productUnitData = factory(ProductUnit::class)->make();

        /** @var  \App\Repositories\ProductUnitRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductUnitRepositoryInterface::class);
        $this->assertNotNull($repository);

        $productUnitCheck = $repository->create($productUnitData->toFillableArray());
        $this->assertNotNull($productUnitCheck);
    }

    public function testUpdate()
    {
        $productUnitData = factory(ProductUnit::class)->create();

        /** @var  \App\Repositories\ProductUnitRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductUnitRepositoryInterface::class);
        $this->assertNotNull($repository);

        $productUnitCheck = $repository->update($productUnitData, $productUnitData->toFillableArray());
        $this->assertNotNull($productUnitCheck);
    }

    public function testDelete()
    {
        $productUnitData = factory(ProductUnit::class)->create();

        /** @var  \App\Repositories\ProductUnitRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductUnitRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($productUnitData);

        $productUnitCheck = $repository->find($productUnitData->id);
        $this->assertNull($productUnitCheck);
    }

}
