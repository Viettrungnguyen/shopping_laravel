<?php

use App\Role;
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('name', 'admin')->first();
        $user_role = Role::where('name', 'user')->first();
        $admin = User::where([
            ['name', 'admin']
        ])->first();

        $user = User::where('name', 'user')->first();

        if ($admin === null) {

            $admin = new User();
            $admin->name = 'admin';
            $admin->email = 'admin@gmail.com';
            $admin->is_active = User::ACTIVE;
            $admin->password = Hash::make('12345678');
            $admin->email_verified_at = now();
            $admin->title = Str::random(10);
            $admin->gender = "nam";
            $admin->avatar_url = "";
            $admin->avatar_name = "";
            $admin->education = Str::random(10);
            $admin->location = "Ha noi";
            $admin->skills = "PHP, Laravel";
            $admin->note = Str::random(10);
            $admin->phone = "1234567890";
            $admin->birthday = "28/02/1999";
            $admin->slug = Str::slug($admin->name);

            $admin->save();
            $admin->roles()->attach($admin_role);
        }

        if ($user === null) {

            $user = new User();
            $user->name = 'user';
            $user->email = 'user@gmail.com';
            $user->is_active = User::ACTIVE;
            $user->password = Hash::make('12345678');
            $user->email_verified_at = now();
            $user->title = Str::random(10);
            $user->gender = "nam";
            $user->avatar_url = "";
            $user->avatar_name = "";
            $user->education = Str::random(10);
            $user->location = "Ha noi";
            $user->skills = "PHP, Laravel";
            $user->note = Str::random(10);
            $user->phone = "12345654690";
            $user->birthday = "28/02/1999";
            $user->slug = Str::slug($user->name);

            $user->save();
            $user->roles()->attach($user_role);
        }

        //  User::factory(100)->create();
        // $user->each(function ($u) {
        //     $u->userInfo()->save(User_Info::factory()->make());
        // });

    }
}
