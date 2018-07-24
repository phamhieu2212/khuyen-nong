<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\AdminUser;
use App\Models\Htx;

class FarmerPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    /**
    * @return \App\Models\AdminUser
    * */
    public function adminUser()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('AdminUserModel');
            $cached = Redis::hget($cacheKey, $this->entity->admin_user_id);

            if( $cached ) {
                $adminUser = new AdminUser(json_decode($cached, true));
                $adminUser['id'] = json_decode($cached, true)['id'];
                return $adminUser;
            } else {
                $adminUser = $this->entity->adminUser;
                Redis::hsetnx($cacheKey, $this->entity->admin_user_id, $adminUser);
                return $adminUser;
            }
        }

        $adminUser = $this->entity->adminUser;
        return $adminUser;
    }

    /**
    * @return \App\Models\Htx
    * */
    public function htx()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('HtxModel');
            $cached = Redis::hget($cacheKey, $this->entity->htx_id);

            if( $cached ) {
                $htx = new Htx(json_decode($cached, true));
                $htx['id'] = json_decode($cached, true)['id'];
                return $htx;
            } else {
                $htx = $this->entity->htx;
                Redis::hsetnx($cacheKey, $this->entity->htx_id, $htx);
                return $htx;
            }
        }

        $htx = $this->entity->htx;
        return $htx;
    }

    
}
