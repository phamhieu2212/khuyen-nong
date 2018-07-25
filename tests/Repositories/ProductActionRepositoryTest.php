<?php namespace Tests\Repositories;

use App\Models\ProductAction;
use Tests\TestCase;

class ProductActionRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ProductActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductActionRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $productActions = factory(ProductAction::class, 3)->create();
        $productActionIds = $productActions->pluck('id')->toArray();

        /** @var  \App\Repositories\ProductActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $productActionsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(ProductAction::class, $productActionsCheck[0]);

        $productActionsCheck = $repository->getByIds($productActionIds);
        $this->assertEquals(3, count($productActionsCheck));
    }

    public function testFind()
    {
        $productActions = factory(ProductAction::class, 3)->create();
        $productActionIds = $productActions->pluck('id')->toArray();

        /** @var  \App\Repositories\ProductActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $productActionCheck = $repository->find($productActionIds[0]);
        $this->assertEquals($productActionIds[0], $productActionCheck->id);
    }

    public function testCreate()
    {
        $productActionData = factory(ProductAction::class)->make();

        /** @var  \App\Repositories\ProductActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $productActionCheck = $repository->create($productActionData->toFillableArray());
        $this->assertNotNull($productActionCheck);
    }

    public function testUpdate()
    {
        $productActionData = factory(ProductAction::class)->create();

        /** @var  \App\Repositories\ProductActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $productActionCheck = $repository->update($productActionData, $productActionData->toFillableArray());
        $this->assertNotNull($productActionCheck);
    }

    public function testDelete()
    {
        $productActionData = factory(ProductAction::class)->create();

        /** @var  \App\Repositories\ProductActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ProductActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($productActionData);

        $productActionCheck = $repository->find($productActionData->id);
        $this->assertNull($productActionCheck);
    }

}
