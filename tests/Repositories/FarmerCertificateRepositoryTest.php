<?php namespace Tests\Repositories;

use App\Models\FarmerCertificate;
use Tests\TestCase;

class FarmerCertificateRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\FarmerCertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerCertificateRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $farmerCertificates = factory(FarmerCertificate::class, 3)->create();
        $farmerCertificateIds = $farmerCertificates->pluck('id')->toArray();

        /** @var  \App\Repositories\FarmerCertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerCertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $farmerCertificatesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(FarmerCertificate::class, $farmerCertificatesCheck[0]);

        $farmerCertificatesCheck = $repository->getByIds($farmerCertificateIds);
        $this->assertEquals(3, count($farmerCertificatesCheck));
    }

    public function testFind()
    {
        $farmerCertificates = factory(FarmerCertificate::class, 3)->create();
        $farmerCertificateIds = $farmerCertificates->pluck('id')->toArray();

        /** @var  \App\Repositories\FarmerCertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerCertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $farmerCertificateCheck = $repository->find($farmerCertificateIds[0]);
        $this->assertEquals($farmerCertificateIds[0], $farmerCertificateCheck->id);
    }

    public function testCreate()
    {
        $farmerCertificateData = factory(FarmerCertificate::class)->make();

        /** @var  \App\Repositories\FarmerCertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerCertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $farmerCertificateCheck = $repository->create($farmerCertificateData->toFillableArray());
        $this->assertNotNull($farmerCertificateCheck);
    }

    public function testUpdate()
    {
        $farmerCertificateData = factory(FarmerCertificate::class)->create();

        /** @var  \App\Repositories\FarmerCertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerCertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $farmerCertificateCheck = $repository->update($farmerCertificateData, $farmerCertificateData->toFillableArray());
        $this->assertNotNull($farmerCertificateCheck);
    }

    public function testDelete()
    {
        $farmerCertificateData = factory(FarmerCertificate::class)->create();

        /** @var  \App\Repositories\FarmerCertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\FarmerCertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($farmerCertificateData);

        $farmerCertificateCheck = $repository->find($farmerCertificateData->id);
        $this->assertNull($farmerCertificateCheck);
    }

}
