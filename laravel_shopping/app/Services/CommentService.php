<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

class CommentService extends BaseService
{
    public function getRepository()
    {
        return CommentRepository::class;
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
        $result = $this->repository->create($req);

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
