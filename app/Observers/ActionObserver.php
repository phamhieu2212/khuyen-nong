<?php namespace App\Observers;

use Illuminate\Support\Facades\Redis;

class ActionObserver extends BaseObserver
{
    protected $cachePrefix = 'ActionModel';

    public function created($model)
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel($this->cachePrefix);
            Redis::hsetnx($cacheKey, $model->id, $model);
        }
    }

    public function updated($model)
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel($this->cachePrefix);
            Redis::hset($cacheKey, $model->id, $model);
        }
    }

    public function deleted($model)
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel($this->cachePrefix);
            Redis::hdel($cacheKey, $model->id);
        }
    }
}