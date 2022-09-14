<?php

namespace App\Repositories;

use App\Notification;
use App\NotificationUser;
use App\User;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use App\Role;
use Illuminate\Support\Facades\Hash;

class LoginRepository extends BaseRepository
{
    const TYPE_REGISTER = '3';
    const READ_NOT = '0';

    public function getModel()
    {
        return User::class;
    }

    public function register($req)
    {
        $role = Role::where('name', 'user')->first();
        $result = new $this->model;

        $result->name = $req->name;
        $result->email = $req->email;
        $result->password = Hash::make($req->password);
        $result->title = "";
        $result->gender = "";
        $result->avatar_url = "";
        $result->avatar_name = "";
        $result->education = "";
        $result->location = "";
        $result->skills = "";
        $result->note = "";
        $result->birthday = "";
        $result->is_active = "";
        $result->phone = "";
        $result->slug = Str::slug($req->name);

        $result->save();
        $result->roles()->attach($role);

        $notification = new Notification();
        $notification->title = 'register account';
        $notification->content =  $result->name . '-' . now()->format('Y-m-d H:i:s');
        $notification->type = self::TYPE_REGISTER;
        $notification->url = "register";
        $notification->save();

        $user_notification = new NotificationUser();
        $user_notification->notification_id = $notification->id;
        $user_notification->user_id = $result->id;
        $user_notification->is_read = self::READ_NOT;
        $user_notification->save();

        return $result;
    }
}
