<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();
        if (!$admin) {
            $admin = new Role();
            $admin->name = 'admin';
            $admin->save();
        }

        if (!$user) {
            $user = new Role();
            $user->name = 'user';
            $user->save();
        }
    }
}
