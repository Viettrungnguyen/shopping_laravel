<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $table = 'user_notifications';
    protected $gruad = [];

    public function notifications()
    {
        return $this->belongsTo(Notification::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
