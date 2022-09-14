<?php

namespace App\Services;

use App\Repositories\PaymentRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;

class PaymentService extends BaseService
{
    public function getRepository()
    {
        return PaymentRepository::class;
    }

    public function vnpay_payment($req, $vnp_Url)
    {
        return $this->repository->vnpay_payment($req, $vnp_Url);
    }

    public function cartComplete($req)
    {
        DB::beginTransaction();
        try {
            $result = $this->repository->cartComplete($req);
        } catch (Exception $e) {
            dd($e);
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
