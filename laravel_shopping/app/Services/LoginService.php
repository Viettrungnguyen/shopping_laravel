<?php

namespace App\Services;

use App\Repositories\LoginRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

class LoginService extends BaseService
{
    public function getRepository()
    {
        return LoginRepository::class;
    }

    public function register($req)
    {
        $result = $this->repository->register($req);

        return $result;
    }
}
