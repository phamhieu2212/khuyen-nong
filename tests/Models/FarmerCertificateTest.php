<?php namespace Tests\Models;

use App\Models\FarmerCertificate;
use Tests\TestCase;

class FarmerCertificateTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\FarmerCertificate $farmerCertificate */
        $farmerCertificate = new FarmerCertificate();
        $this->assertNotNull($farmerCertificate);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\FarmerCertificate $farmerCertificate */
        $farmerCertificateModel = new FarmerCertificate();

        $farmerCertificateData = factory(FarmerCertificate::class)->make();
        foreach( $farmerCertificateData->toFillableArray() as $key => $value ) {
            $farmerCertificateModel->$key = $value;
        }
        $farmerCertificateModel->save();

        $this->assertNotNull(FarmerCertificate::find($farmerCertificateModel->id));
    }

}
