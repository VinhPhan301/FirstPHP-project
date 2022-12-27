<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getUser();
    
    public function updateIfNull($userId, $attributes);
}