<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    const MAN = 'nam';
    const FEMALE = 'nữ';
    const GENDER = [
        User::MAN,
        User::FEMALE
    ];
    const ACTIVE = 'active';
    const DEACTIVE = 'deactive';
    const STATUS = [
        User::ACTIVE,
        User::DEACTIVE
    ];
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE = [
        User::ROLE_USER,
        User::ROLE_ADMIN
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'title', 'gender', 'avatar_url', 'education', 'location', 'skills', 'note', 'birthday', 'is_active', 'slug', 'avatar_name', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hashPassword()
    {
        $hashedPassword = Hash::make($this->password);
        $this->password = $hashedPassword;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function user_notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'user_notifications', 'user_id', 'notification_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
