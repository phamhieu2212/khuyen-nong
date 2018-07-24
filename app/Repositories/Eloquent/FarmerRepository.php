<?php namespace App\Repositories\Eloquent;

use \App\Repositories\FarmerRepositoryInterface;
use \App\Models\Farmer;

class FarmerRepository extends SingleKeyModelRepository implements FarmerRepositoryInterface
{

    public function getBlankModel()
    {
        return new Farmer();
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
    public function checkFarmer($htxId,$adminUserId, $roles)
    {
        foreach($roles as $role)
        {
            if($role == 'farmer')
            {
                $this->create([
                    'admin_user_id'=> $adminUserId,
                    'htx_id'       => $htxId
                ]);
            }
        }
    }

}
