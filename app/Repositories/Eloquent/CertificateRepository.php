<?php namespace App\Repositories\Eloquent;

use \App\Repositories\CertificateRepositoryInterface;
use \App\Models\Certificate;

class CertificateRepository extends SingleKeyModelRepository implements CertificateRepositoryInterface
{

    public function getBlankModel()
    {
        return new Certificate();
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
