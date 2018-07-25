<?php namespace App\Repositories\Eloquent;

use \App\Repositories\ProductActionRepositoryInterface;
use \App\Models\ProductAction;

class ProductActionRepository extends SingleKeyModelRepository implements ProductActionRepositoryInterface
{

    public function getBlankModel()
    {
        return new ProductAction();
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
