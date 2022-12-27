<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface VoucherRepositoryInterface extends BaseRepositoryInterface
{
    public function createFirstVoucher($userId);
    public function getVoucherByUser($userId);
}
