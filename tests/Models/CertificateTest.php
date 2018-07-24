<?php namespace Tests\Models;

use App\Models\Certificate;
use Tests\TestCase;

class CertificateTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Certificate $certificate */
        $certificate = new Certificate();
        $this->assertNotNull($certificate);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Certificate $certificate */
        $certificateModel = new Certificate();

        $certificateData = factory(Certificate::class)->make();
        foreach( $certificateData->toFillableArray() as $key => $value ) {
            $certificateModel->$key = $value;
        }
        $certificateModel->save();

        $this->assertNotNull(Certificate::find($certificateModel->id));
    }

}
