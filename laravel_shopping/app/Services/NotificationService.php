<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\NotificationRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

class NotificationService extends BaseService
{
    public function getRepository()
    {
        return NotificationRepository::class;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function findNotificationUser()
    {
        return $this->repository->findNotificationUser();
    }

    public function create($req, $title)
    {
        $result = $this->repository->create($req, $title);

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
}
