<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Services\BaseService;

class CartService extends BaseService
{
    public function getRepository()
    {
        return CartRepository::class;
    }

    public function addCart($slug)
    {
        $result = $this->repository->addCart($slug);

        return $result;
    }
    
    public function addCartQuantity($slug, $req)
    {
        $result = $this->repository->addCartQuantity($slug, $req);

        return $result;
    }

    public function updateCart($req)
    {
        $result = $this->repository->updateCart($req);

        return $result;
    }

    public function removeCart($req)
    {
        $result = $this->repository->removeCart($req);

        return $result;
    }
}
