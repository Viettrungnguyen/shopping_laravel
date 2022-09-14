<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $filable = ['title', 'content', 'url', 'type'];

    public function user_contification()
    {
        return $this->hasMany(NotificationUser::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications', 'user_id', 'notification_id');
    }
}
