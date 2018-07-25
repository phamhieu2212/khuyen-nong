<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\Product;
use App\Models\Action;

class ProductActionPresenter extends BasePresenter
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
    * @return \App\Models\Action
    * */
    public function action()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('ActionModel');
            $cached = Redis::hget($cacheKey, $this->entity->action_id);

            if( $cached ) {
                $action = new Action(json_decode($cached, true));
                $action['id'] = json_decode($cached, true)['id'];
                return $action;
            } else {
                $action = $this->entity->action;
                Redis::hsetnx($cacheKey, $this->entity->action_id, $action);
                return $action;
            }
        }

        $action = $this->entity->action;
        return $action;
    }

    
}
