<?php

namespace App\Repositories\Product;

use App\Models\Voucher;
use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\Product\VoucherRepositoryInterface;

class VoucherRepository extends BaseRepository implements VoucherRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Voucher::class;
    }

    public function getVoucherByUser($userId)
    {
        $voucher = $this->model->where('user_id', $userId)->get();

        return $voucher;
    }


    public function createFirstVoucher($userId)
    {
        $firstVoucher = $this->create([
            'name' => 'CNF-DC-15',
            'user_id' => $userId,
            'discount' => '15'
        ]);
        $secondVoucher = $this->create([
            'name' => 'CNF-DC-10',
            'user_id' => $userId,
            'discount' => '10'
        ]);

        return true;
    }

    public function deleteVoucher($orderId)
    {
        $orderFound = Order::where('id', $orderId)->first();
        $voucherFound = $this->model
            ->where('user_id', $orderFound->user_id)
            ->where('discount', $orderFound->discount)
            ->first();
        $voucherDelete = $this->delete($voucherFound->id);

        return  $voucherDelete;
    }
}
