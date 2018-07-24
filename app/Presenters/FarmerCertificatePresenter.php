<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\AdminUser;
use App\Models\Cetificate;

class FarmerCertificatePresenter extends BasePresenter
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
    * @return \App\Models\Cetificate
    * */
    public function cetificate()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('CetificateModel');
            $cached = Redis::hget($cacheKey, $this->entity->cetificate_id);

            if( $cached ) {
                $cetificate = new Cetificate(json_decode($cached, true));
                $cetificate['id'] = json_decode($cached, true)['id'];
                return $cetificate;
            } else {
                $cetificate = $this->entity->cetificate;
                Redis::hsetnx($cacheKey, $this->entity->cetificate_id, $cetificate);
                return $cetificate;
            }
        }

        $cetificate = $this->entity->cetificate;
        return $cetificate;
    }

    
}
