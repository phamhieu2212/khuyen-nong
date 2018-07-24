<?php namespace Tests\Repositories;

use App\Models\Action;
use Tests\TestCase;

class ActionRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ActionRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $actions = factory(Action::class, 3)->create();
        $actionIds = $actions->pluck('id')->toArray();

        /** @var  \App\Repositories\ActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $actionsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Action::class, $actionsCheck[0]);

        $actionsCheck = $repository->getByIds($actionIds);
        $this->assertEquals(3, count($actionsCheck));
    }

    public function testFind()
    {
        $actions = factory(Action::class, 3)->create();
        $actionIds = $actions->pluck('id')->toArray();

        /** @var  \App\Repositories\ActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $actionCheck = $repository->find($actionIds[0]);
        $this->assertEquals($actionIds[0], $actionCheck->id);
    }

    public function testCreate()
    {
        $actionData = factory(Action::class)->make();

        /** @var  \App\Repositories\ActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $actionCheck = $repository->create($actionData->toFillableArray());
        $this->assertNotNull($actionCheck);
    }

    public function testUpdate()
    {
        $actionData = factory(Action::class)->create();

        /** @var  \App\Repositories\ActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $actionCheck = $repository->update($actionData, $actionData->toFillableArray());
        $this->assertNotNull($actionCheck);
    }

    public function testDelete()
    {
        $actionData = factory(Action::class)->create();

        /** @var  \App\Repositories\ActionRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ActionRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($actionData);

        $actionCheck = $repository->find($actionData->id);
        $this->assertNull($actionCheck);
    }

}
