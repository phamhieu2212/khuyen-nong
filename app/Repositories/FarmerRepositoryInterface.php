<?php namespace App\Repositories;

interface FarmerRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    public function checkFarmer($htxId,$adminUserId, $roles);
}