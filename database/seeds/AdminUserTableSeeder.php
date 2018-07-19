<?php

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use App\Models\AdminUserRole;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $superUser = factory( AdminUser::class )->create(
            [
                'name'     => 'Admin Tổng',
                'email'    => 'super@example.com',
                'password' => '123',
            ]
        );
        factory( AdminUserRole::class )->create(
            [
                'admin_user_id' => $superUser->id,
                'role'          => 'super_user',
            ]
        );
        $adminUser = factory( AdminUser::class )->create(
            [
                'name'     => 'Quản Trị Viên',
                'email'    => 'admin@example.com',
                'password' => '123',
            ]
        );
        factory( AdminUserRole::class )->create(
            [
                'admin_user_id' => $adminUser->id,
                'role'          => 'admin',
            ]
        );

        $htx = factory( AdminUser::class )->create(
            [
                'name'     => 'Quản Lý HTX',
                'email'    => 'htx@example.com',
                'password' => '123',
            ]
        );
        factory( AdminUserRole::class )->create(
            [
                'admin_user_id' => $htx->id,
                'role'          => 'htx',
            ]
        );

        $farmer = factory( AdminUser::class )->create(
            [
                'name'     => 'Nông Dân',
                'email'    => 'farmer@example.com',
                'password' => '123',
            ]
        );
        factory( AdminUserRole::class )->create(
            [
                'admin_user_id' => $farmer->id,
                'role'          => 'farmer',
            ]
        );
    }
}
