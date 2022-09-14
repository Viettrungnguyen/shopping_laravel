<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

class UserService extends BaseService
{
    public function getRepository()
    {
        return UserRepository::class;
    }

    public function getAll($searchTerm)
    {
        return $this->repository->getAll($searchTerm);
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

    public function editProfile($id){
        return $this->repository->editProfile($id);
    }

    public function updateProfile($req,$id)
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->updateProfile($req,$id);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();

        return $result;
    }
}
