<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\Category;
use App\Models\Image;

class ProductPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = ['cover_image'];

    /**
    * @return \App\Models\Category
    * */
    public function category()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('CategoryModel');
            $cached = Redis::hget($cacheKey, $this->entity->category_id);

            if( $cached ) {
                $category = new Category(json_decode($cached, true));
                $category['id'] = json_decode($cached, true)['id'];
                return $category;
            } else {
                $category = $this->entity->category;
                Redis::hsetnx($cacheKey, $this->entity->category_id, $category);
                return $category;
            }
        }

        $category = $this->entity->category;
        return $category;
    }

    /**
    * @return \App\Models\Image
    * */
    public function coverImage()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('ImageModel');
            $cached = Redis::hget($cacheKey, $this->entity->cover_image_id);

            if( $cached ) {
                $image = new Image(json_decode($cached, true));
                $image['id'] = json_decode($cached, true)['id'];
                return $image;
            } else {
                $image = $this->entity->coverImage;
                Redis::hsetnx($cacheKey, $this->entity->cover_image_id, $image);
                return $image;
            }
        }

        $image = $this->entity->coverImage;
        return $image;
    }

    
}
