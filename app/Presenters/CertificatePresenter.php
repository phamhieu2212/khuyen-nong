<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\Image;
use App\Models\Image;

class CertificatePresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = ['logo_image','cover_image'];

    /**
    * @return \App\Models\Image
    * */
    public function logoImage()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('ImageModel');
            $cached = Redis::hget($cacheKey, $this->entity->logo_image_id);

            if( $cached ) {
                $image = new Image(json_decode($cached, true));
                $image['id'] = json_decode($cached, true)['id'];
                return $image;
            } else {
                $image = $this->entity->logoImage;
                Redis::hsetnx($cacheKey, $this->entity->logo_image_id, $image);
                return $image;
            }
        }

        $image = $this->entity->logoImage;
        return $image;
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
