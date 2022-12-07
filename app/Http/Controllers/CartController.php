<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Constants\CommonConstant;
use App\Repositories\Product\CartRepositoryInterface;

class CartController extends Controller
{   
    protected $cartRepo;

    public function __construct(CartRepositoryInterface $cartRepo)
    {
        $this->cartRepo = $cartRepo;
    }

    public function getViewCart()
    {  
        return view('shop.cart');
    }

    public function createCart(Request $request)
    {
        if(Auth::guard('user')->check() == false){
            return 'false';
        }
        else{
            $userID = $request->userID;

            $data = [
                'user_id' => $userID,
                'status' => 'active',
            ];
    
            $cart = $this->cartRepo->create($data);
        }
        
    }

}
