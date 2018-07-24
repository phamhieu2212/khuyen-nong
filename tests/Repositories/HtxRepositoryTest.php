<?php namespace Tests\Repositories;

use App\Models\Htx;
use Tests\TestCase;

class HtxRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\HtxRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\HtxRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $htxes = factory(Htx::class, 3)->create();
        $htxIds = $htxes->pluck('id')->toArray();

        /** @var  \App\Repositories\HtxRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\HtxRepositoryInterface::class);
        $this->assertNotNull($repository);

        $htxesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Htx::class, $htxesCheck[0]);

        $htxesCheck = $repository->getByIds($htxIds);
        $this->assertEquals(3, count($htxesCheck));
    }

    public function testFind()
    {
        $htxes = factory(Htx::class, 3)->create();
        $htxIds = $htxes->pluck('id')->toArray();

        /** @var  \App\Repositories\HtxRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\HtxRepositoryInterface::class);
        $this->assertNotNull($repository);

        $htxCheck = $repository->find($htxIds[0]);
        $this->assertEquals($htxIds[0], $htxCheck->id);
    }

    public function testCreate()
    {
        $htxData = factory(Htx::class)->make();

        /** @var  \App\Repositories\HtxRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\HtxRepositoryInterface::class);
        $this->assertNotNull($repository);

        $htxCheck = $repository->create($htxData->toFillableArray());
        $this->assertNotNull($htxCheck);
    }

    public function testUpdate()
    {
        $htxData = factory(Htx::class)->create();

        /** @var  \App\Repositories\HtxRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\HtxRepositoryInterface::class);
        $this->assertNotNull($repository);

        $htxCheck = $repository->update($htxData, $htxData->toFillableArray());
        $this->assertNotNull($htxCheck);
    }

    public function testDelete()
    {
        $htxData = factory(Htx::class)->create();

        /** @var  \App\Repositories\HtxRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\HtxRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($htxData);

        $htxCheck = $repository->find($htxData->id);
        $this->assertNull($htxCheck);
    }

}
