<?php namespace Tests\Repositories;

use App\Models\Farmer;
use Tests\TestCase;

class FarmerRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\FarmerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $farmers = factory(Farmer::class, 3)->create();
        $farmerIds = $farmers->pluck('id')->toArray();

        /** @var  \App\Repositories\FarmerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $farmersCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Farmer::class, $farmersCheck[0]);

        $farmersCheck = $repository->getByIds($farmerIds);
        $this->assertEquals(3, count($farmersCheck));
    }

    public function testFind()
    {
        $farmers = factory(Farmer::class, 3)->create();
        $farmerIds = $farmers->pluck('id')->toArray();

        /** @var  \App\Repositories\FarmerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $farmerCheck = $repository->find($farmerIds[0]);
        $this->assertEquals($farmerIds[0], $farmerCheck->id);
    }

    public function testCreate()
    {
        $farmerData = factory(Farmer::class)->make();

        /** @var  \App\Repositories\FarmerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $farmerCheck = $repository->create($farmerData->toFillableArray());
        $this->assertNotNull($farmerCheck);
    }

    public function testUpdate()
    {
        $farmerData = factory(Farmer::class)->create();

        /** @var  \App\Repositories\FarmerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $farmerCheck = $repository->update($farmerData, $farmerData->toFillableArray());
        $this->assertNotNull($farmerCheck);
    }

    public function testDelete()
    {
        $farmerData = factory(Farmer::class)->create();

        /** @var  \App\Repositories\FarmerRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($farmerData);

        $farmerCheck = $repository->find($farmerData->id);
        $this->assertNull($farmerCheck);
    }

}
