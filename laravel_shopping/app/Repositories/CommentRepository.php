<?php

namespace App\Repositories;

use App\Comment;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class CommentRepository extends BaseRepository
{
    public function getModel()
    {
        return Comment::class;
    }

    public function getAll()
    {
        return $this->model->orderByDesc('id')->paginate(5);
    }

    public function getSingle($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create($req)
    {
        $comment = new $this->model;
        $comment->content = $req['content'];
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $req['productId'];
        $comment->save();

        return $comment->fresh();
    }

    public function update($id, $req)
    {
        $cate = $this->model->find($id);
        $cate->name = $req['name'];
        $cate->slug = Str::slug($req['name']);
        $cate->save();

        return $cate;
    }

    public function delete($id)
    {
        $cate = $this->model->find($id);
        $cate->delete();

        return $cate;
    }
}
