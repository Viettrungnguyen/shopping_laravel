<?php

namespace App\Repositories;

use App\Category;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function getModel()
    {
        return Category::class;
    }

    public function getAll($searchTerm)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);

        if ($searchTerm != "") {
            $categories =  $this->model::where('name', 'like', "%{$searchTerm}%")->orderByDesc('id')->paginate(5);
        }
        if ($searchTerm == "") {
            $categories = $this->model::orderByDesc('id')->paginate(5);
        }

        return $categories;
    }

    public function getSingle($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create($req)
    {
        $category = new $this->model;

        $category->name = $req['name'];
        $category->slug = Str::slug($req['name']);
        $category->save();

        return $category->fresh();
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
