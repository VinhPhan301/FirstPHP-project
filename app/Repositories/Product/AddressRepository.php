<?php

namespace App\Repositories\Product;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Product\AddressRepositoryInterface;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Address::class;
    }
}
