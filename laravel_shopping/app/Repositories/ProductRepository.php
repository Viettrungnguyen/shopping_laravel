<?php

namespace App\Repositories;

use App\Product;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;
use App\Tags;
use App\Traits\StorageImage;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository
{
    use StorageImage;

    public function getModel()
    {
        return Product::class;
    }

    public function getAll($searchTerm)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);

        if ($searchTerm != "") {
            $products =  $this->model::where('name', 'like', "%{$searchTerm}%")->orderByDesc('id')->paginate(5);
        }
        if ($searchTerm == "") {
            $products = $this->model->orderByDesc('id')->paginate(5);
        }
        return $products;
    }

    public function getSingle($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create($req)
    {

        $product = new $this->model;

        $product->name = $req->name;
        $product->code = $req->code;
        $product->description = $req->description;
        $product->image_url = $req->image_url;
        $product->price = $req->price;
        $product->slug = Str::slug($req->name);
        $product->category_id = $req->category_id;

        $dataUploadImage = $this->storageImage($req, 'image_url', 'image_products');

        if (!empty($dataUploadImage)) {

            $product->image_name = $dataUploadImage['file_name'];
            $product->image_url = $dataUploadImage['file_path'];
        }

        $product->save();

        if (!empty($req->tags)) {

            foreach ($req->tags as $tagItem) {

                $tagInstance = Tags::firstOrCreate(['name' => $tagItem]);

                $tagIds[] = $tagInstance->id;
            }
        }

        $product->tags()->attach($tagIds);

        return $product->fresh();
    }

    public function update($id, $req)
    {

        $product = $this->model->find($id);

        $product->name = $req->name;
        $product->code = $req->code;
        $product->description = $req->description;
        $product->image_url = $req->image_url;
        $product->price = $req->price;
        $product->slug = Str::slug($req->name);
        $product->category_id = $req->category_id;

        $dataUploadImage = $this->storageImage($req, 'image_url', 'image_products');
        if (!empty($dataUploadImage)) {

            $product->image_name = $dataUploadImage['file_name'];
            $product->image_url = $dataUploadImage['file_path'];
        }

        $product->save();

        if (!empty($req->tags)) {
            foreach ($req->tags as $tagItem) {

                $tagInstance = Tags::firstOrCreate(['name' => $tagItem]);
                $tagIds[] = $tagInstance->id;
            }
        }

        $product->tags()->attach($tagIds);

        return $product;
    }

    public function delete($id)
    {
        $product = $this->model->findOrFail($id);
        $product->tags()->detach();
        $product->delete();

        return $product;
    }
}
