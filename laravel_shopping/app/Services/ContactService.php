<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ContactRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

class ContactService extends BaseService
{
    public function getRepository()
    {
        return ContactRepository::class;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getSingle($slug)
    {
        return $this->repository->getSingle($slug);
    }

    public function create($req)
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->create($req);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();

        return $result;
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
