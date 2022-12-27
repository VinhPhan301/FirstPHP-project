<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface FavoriteRepositoryInterface extends BaseRepositoryInterface
{
    public function getFavorite($userId, $productId);

    public function getFavoriteByUser($userId);

    public function deleteFavorite($userId, $productId);
}
