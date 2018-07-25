<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\Product;
use App\Models\Unit;

class ProductUnitPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    /**
    * @return \App\Models\Product
    * */
    public function product()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('ProductModel');
            $cached = Redis::hget($cacheKey, $this->entity->product_id);

            if( $cached ) {
                $product = new Product(json_decode($cached, true));
                $product['id'] = json_decode($cached, true)['id'];
                return $product;
            } else {
                $product = $this->entity->product;
                Redis::hsetnx($cacheKey, $this->entity->product_id, $product);
                return $product;
            }
        }

        $product = $this->entity->product;
        return $product;
    }

    /**
    * @return \App\Models\Unit
    * */
    public function unit()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('UnitModel');
            $cached = Redis::hget($cacheKey, $this->entity->unit_id);

            if( $cached ) {
                $unit = new Unit(json_decode($cached, true));
                $unit['id'] = json_decode($cached, true)['id'];
                return $unit;
            } else {
                $unit = $this->entity->unit;
                Redis::hsetnx($cacheKey, $this->entity->unit_id, $unit);
                return $unit;
            }
        }

        $unit = $this->entity->unit;
        return $unit;
    }

    
}
