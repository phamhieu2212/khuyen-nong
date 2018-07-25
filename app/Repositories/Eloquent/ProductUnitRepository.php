<?php namespace App\Repositories\Eloquent;

use \App\Repositories\ProductUnitRepositoryInterface;
use \App\Models\ProductUnit;

class ProductUnitRepository extends SingleKeyModelRepository implements ProductUnitRepositoryInterface
{

    public function getBlankModel()
    {
        return new ProductUnit();
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
