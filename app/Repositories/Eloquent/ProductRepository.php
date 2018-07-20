<?php namespace App\Repositories\Eloquent;

use \App\Repositories\ProductRepositoryInterface;
use \App\Models\Product;

class ProductRepository extends SingleKeyModelRepository implements ProductRepositoryInterface
{

    public function getBlankModel()
    {
        return new Product();
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
