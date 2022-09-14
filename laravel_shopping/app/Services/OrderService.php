<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

class OrderService extends BaseService
{
    public function getRepository()
    {
        return OrderRepository::class;
    }

    public function getAll($searchTerm)
    {
        return $this->repository->getAll($searchTerm);
    }

    public function getSingle($id)
    {
        return $this->repository->getSingle($id);
    }


    public function update($id, $req)
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->update($id, $req);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();

        return $result;
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();

        return $result;
    }
}
