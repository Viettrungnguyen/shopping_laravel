<?php

namespace App\Repositories;

use App\Category;
use App\Contact;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;

class ContactRepository extends BaseRepository
{
    const STATUS_WAITING = 'waiting';
    const STATUS_COMPLETE = 'complete';
    const STATUS = [
        ContactRepository::STATUS_WAITING,
        ContactRepository::STATUS_COMPLETE
    ];

    public function getModel()
    {
        return Contact::class;
    }

    public function getAll()
    {
        return $this->model->orderByDesc('created_at')->paginate(5);
    }

    public function getSingle($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create($req)
    {
        $result = new $this->model;

        $result->email = $req['email'];
        $result->phone = $req['phone'];
        $result->name = $req['name'];
        $result->status = self::STATUS_WAITING;
        $result->slug = Str::slug($req['name']);
        $result->save();

        return $result->fresh();
    }

    public function update($id, $req)
    {
        $result = $this->model->find($id);
        $result->email = $req['email'];
        $result->phone = $req['phone'];
        $result->name = $req['name'];
        $result->status = $req['status'];
        $result->slug = Str::slug($req['name']);
        $result->save();

        return $result;
    }

    public function delete($id)
    {
        $cate = $this->model->find($id);
        $cate->delete();

        return $cate;
    }
}
