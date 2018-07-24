<?php namespace App\Repositories\Eloquent;

use \App\Repositories\HtxRepositoryInterface;
use \App\Models\Htx;

class HtxRepository extends SingleKeyModelRepository implements HtxRepositoryInterface
{

    public function getBlankModel()
    {
        return new Htx();
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
