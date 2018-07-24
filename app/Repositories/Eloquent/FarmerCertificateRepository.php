<?php namespace App\Repositories\Eloquent;

use \App\Repositories\FarmerCertificateRepositoryInterface;
use \App\Models\FarmerCertificate;

class FarmerCertificateRepository extends SingleKeyModelRepository implements FarmerCertificateRepositoryInterface
{

    public function getBlankModel()
    {
        return new FarmerCertificate();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
