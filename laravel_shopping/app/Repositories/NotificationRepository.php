<?php

namespace App\Repositories;

use App\Category;
use App\Notification;
use App\NotificationUser;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class NotificationRepository extends BaseRepository
{
    const TITLE_COMMENT = 'Comment complete';
    const TYPE_COMMENT = '2';
    const READ_NOT = '0';

    public function getModel()
    {
        return Notification::class;
    }

    public function findNotificationUser()
    {
        $userNotification = NotificationUser::where(
            'user_id',
            Auth::user()->id
        )->first();

       return $notifications = $this->model::where('id', $userNotification->notification_id)->get();
    }

    public function create($req, $title)
    {
        $notification = new $this->model;
        $notification->title = $title;
        $notification->content =  $req->nameProduct . '-' . now()->format('Y-m-d H:i:s');
        $notification->type = self::TYPE_COMMENT;
        $notification->url = "cmt";
        $notification->save();

        $user_notification = new NotificationUser();
        $user_notification->notification_id = $notification->id;
        $user_notification->user_id = Auth::user()->id;
        $user_notification->is_read = self::READ_NOT;
        $user_notification->save();

        return $notification->fresh();
    }
}
