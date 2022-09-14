<?php

namespace App\Repositories;

use App\Order;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository
{
    public function getModel()
    {
        return Order::class;
    }

    public function getAll($searchTerm)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $searchTerm = str_replace($reservedSymbols, ' ', $searchTerm);

        if ($searchTerm != "") {
            $orders =  $this->model::where('customer_name', 'like', "%{$searchTerm}%")->orderByDesc('id')->paginate(5);
        }
        if ($searchTerm == "") {
            $orders = $this->model->orderByDesc('id')->paginate(5);
        }

        return $orders;
    }

    public function getSingle($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update($id, $req)
    {
        $cate = $this->model->find($id);
        $cate->status = $req['status'];
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
