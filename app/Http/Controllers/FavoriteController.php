<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Repositories\Product\FavoriteRepositoryInterface;
use App\Constants\CommonConstant;
use Response;

class FavoriteController extends Controller
{
    protected $favoriteRepo;

    public function __construct(FavoriteRepositoryInterface $favoriteRepo)
    {
        $this->favoriteRepo = $favoriteRepo;
    }



    /**
     * Create new favorite function
     *
     * @param Request $request
     * @return void
     */
    public function createFavorite(Request $request)
    {
        $userId = Auth::guard('user')->user()->id;
        $favorite = $this->favoriteRepo
            ->create([
                'user_id' => $userId,
                'product_id' => $request->productId
            ]);

        return $favorite;
    }



    /**
     * Delete Favorite by userId And productId function
     *
     * @param Request $request
     * @return void
     */
    public function deleteFavorite(Request $request)
    {
        $userId = Auth::guard('user')->user()->id;
        $favorite = $this->favoriteRepo->deleteFavorite($userId, $request->productId);

        return $favorite;
    }



    /**
     * Show View User Favorite function
     *
     * @return void
     */
    public function getViewFavorite()
    {
        $favorites = $this->favoriteRepo->getFavoriteByUser(Auth::guard('user')->user()->id);
        
        return view('shop.userfavorite',[
            'favorites' => $favorites
        ]);
    }
}
