<?php
namespace App\Repositories\Product;
use App\Models\Favorite;
use App\Repositories\BaseRepository;
use App\Repositories\Product\FavoriteRepositoryInterface;

class FavoriteRepository extends BaseRepository implements FavoriteRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Favorite::class;
    }


    public function getFavorite($userId, $productId)
    {
        $favorite = $this->model
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->get();

        return $favorite;
    }

    public function getFavoriteByUser($userId)
    {
        $favorites = $this->model
            ->where('user_id', $userId)
            ->get();

        return $favorites;
    }

    public function deleteFavorite($userId, $productId)
    {
        $favorite = $this->model
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        $favoriteDelete = $this->delete($favorite->id);

        return $favoriteDelete;
    }
}
