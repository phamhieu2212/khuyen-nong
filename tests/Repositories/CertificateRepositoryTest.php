<?php namespace Tests\Repositories;

use App\Models\Certificate;
use Tests\TestCase;

class CertificateRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\CertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CertificateRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $certificates = factory(Certificate::class, 3)->create();
        $certificateIds = $certificates->pluck('id')->toArray();

        /** @var  \App\Repositories\CertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $certificatesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Certificate::class, $certificatesCheck[0]);

        $certificatesCheck = $repository->getByIds($certificateIds);
        $this->assertEquals(3, count($certificatesCheck));
    }

    public function testFind()
    {
        $certificates = factory(Certificate::class, 3)->create();
        $certificateIds = $certificates->pluck('id')->toArray();

        /** @var  \App\Repositories\CertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $certificateCheck = $repository->find($certificateIds[0]);
        $this->assertEquals($certificateIds[0], $certificateCheck->id);
    }

    public function testCreate()
    {
        $certificateData = factory(Certificate::class)->make();

        /** @var  \App\Repositories\CertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $certificateCheck = $repository->create($certificateData->toFillableArray());
        $this->assertNotNull($certificateCheck);
    }

    public function testUpdate()
    {
        $certificateData = factory(Certificate::class)->create();

        /** @var  \App\Repositories\CertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $certificateCheck = $repository->update($certificateData, $certificateData->toFillableArray());
        $this->assertNotNull($certificateCheck);
    }

    public function testDelete()
    {
        $certificateData = factory(Certificate::class)->create();

        /** @var  \App\Repositories\CertificateRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\CertificateRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($certificateData);

        $certificateCheck = $repository->find($certificateData->id);
        $this->assertNull($certificateCheck);
    }

}
