<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserSignupRequest;
use App\Http\Requests\UserUpdateAccountRequest;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\UserRepositoryInterface;
use App\Repositories\Product\CartItemRepositoryInterface;
use App\Repositories\Product\OrderRepositoryInterface;
use App\Repositories\Product\FavoriteRepositoryInterface;
use App\Repositories\Product\VoucherRepositoryInterface;
use App\Constants\CommonConstant;
use Response;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Constants\UserConstant;
use App\Http\Requests\SignupFormRequest;

class ShopController extends Controller
{
    protected $productRepo;
    protected $productDetailRepo;
    protected $userRepo;
    protected $cartItemRepo;
    protected $orderRepo;
    protected $favoriteRepo;
    protected $voucherRepo;

    public function __construct(
        ProductRepositoryInterface $productRepo,
        ProductDetailRepositoryInterface $productDetailRepo,
        UserRepositoryInterface $userRepo,
        CartItemRepositoryInterface $cartItemRepo,
        OrderRepositoryInterface $orderRepo,
        FavoriteRepositoryInterface $favoriteRepo,
        VoucherRepositoryInterface $voucherRepo,
    ) {
        $this->productRepo = $productRepo;
        $this->productDetailRepo = $productDetailRepo;
        $this->userRepo = $userRepo;
        $this->cartItemRepo = $cartItemRepo;
        $this->orderRepo = $orderRepo;
        $this->favoriteRepo = $favoriteRepo;
        $this->voucherRepo = $voucherRepo;
    }


    /**
     * Show Product in Shop function
     *
     * @param Request $request
     * @return void
     */
    public function getView(Request $request)
    {
        $type = $request->query('type');
        if (null !== $request->query('type')) {
            $products = $this->productRepo->getProductType($type);
            $productList = $this->productRepo->getProductName($type);

            return view('shop.view', [
                'products' => $products,
                'type' => $type,
                'productList' => $productList,
                'categoryName' => null, // thua
                'msg' => session()->get(CommonConstant::MSG) ?? null
            ]);
        }

        $products = $this->productRepo->getAll();
        $productList = $this->productRepo->getProductList();

        return view('shop.view', [
            'products' => $products,
            'type' => '',
            'productList' => $productList,
            'categoryName' => null,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Show Chosen Category in Shop function
     *
     * @param Request $request
     * @return void
     */
    public function getViewCategory(Request $request)
    {
        $categoryName = $request->query('category');
        $type = $request->query('type');

        if ($categoryName && $type) {
            $products = $this->productRepo->getViewCategory($type, $categoryName);

            return view('shop.view', [
                'type' => $type,
                'productList' => $products['productList'],
                'products' => $products['products'],
                'categoryName' => $categoryName,
                'msg' => session()->get(CommonConstant::MSG) ?? null
            ]);
        }

        $products = $this->productRepo->getViewCategory($type, $categoryName);

        return view('shop.view', [
            'products' => $products,
            'type' => $type,
            'productList' => [],
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Show chosen Product in Shop function
     *
     * @param Request $request
     * @return void
     */
    public function findProduct(Request $request)
    {
        $categoryName = $request->query('category');
        $type = $request->query('type');
        $productName =$request->query('productName');

        $findProduct = $this->productRepo->findProduct($categoryName, $type, $productName);
        // dd($findProduct);

        return view('shop.findProduct', [
            'dataFound' => $findProduct['dataFound'],
            'type' => $type,
            'categoryName' => $categoryName,
            'allCategories' => $findProduct['allCategories'],
            'allProducts' => $findProduct['allProducts'],
        ]);
    }


    /**
     * Show chosen Product function
     *
     * @param Request $request
     * @return void
     */
    public function getViewProduct(Request $request)
    {
        $productId = $request->query('id');
        $product = $this->productRepo->find($productId);

        $relatedProducts = $this->productRepo->getRelatedProduct($productId, $product);
        $getSizeColor = $this->productDetailRepo->getSizeColor($productId);
        if (Auth::guard('user')->user() !== null) {
            $getFavorite = $this->favoriteRepo->getFavorite(Auth::guard('user')->user()->id, $productId);

            return view('shop.product', [
                'product' => $product,
                'detailSize' => $getSizeColor['sizeUnique'],
                'detailThumbnail' => $getSizeColor['thumbnailUnique'],
                'relatedProducts' => $relatedProducts,
                'favorite' => $getFavorite,
            ]);
        }

        return view('shop.product', [
            'product' => $product,
            'detailSize' => $getSizeColor['sizeUnique'],
            'detailThumbnail' => $getSizeColor['thumbnailUnique'],
            'relatedProducts' => $relatedProducts,
            'favorite' => [],
        ]);
    }


    /**
     * Show SignUp Form for User function
     *
     * @param Request $request
     * @return void
     */
    public function getViewCreate()
    {
        return view('shop.signup', [
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Create New Account for User function
     *
     * @param SignupFormRequest $request
     * @return void
     */
    public function createAccount(UserSignupRequest $request)
    {
        $password = Hash::make($request->password);
        $data = [
           'email' => $request->email,
           'password' => $password,
           'role' => $request->role,
           'status' => 'unlock'
        ];

        $userAccount = $this->userRepo->create($data);
        $createVoucher = $this->voucherRepo->createFirstVoucher($userAccount->id);

        if (!$userAccount || null === $userAccount) {
            return redirect()
                ->route('shop.signup')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return redirect()
            ->route('shop.signup')
            ->with(CommonConstant::MSG, UserConstant::MSG['create_success']);
    }


    /**
     * Show Login Form for User function
     *
     * @return void
     */
    public function getViewLogin()
    {
        return view('shop.login');
    }


    /**
     * User login  function
     *
     * @param Request $request
     * @return void
     */
    public function postLogin(LoginRequest $request)
    {
        $login = [
            UserConstant::COLUMN['email'] => $request->email,
            UserConstant::COLUMN['password'] => $request->password,
        ];

        if (auth()->guard('user')->attempt($login)) {
            $this->currentUser = auth()->guard('user')->user();

            return redirect()
                ->route('shop.view')
                ->with(CommonConstant::MSG, UserConstant::MSG['login_success']);
        } else {
            return redirect()
                ->back()
                ->with('status', UserConstant::MSG['login_fail']);
        }
    }


    /**
     * User Logout function
     *
     * @param Request $request
     * @return void
     */
    public function getLogout(Request $request)
    {
        Auth::guard('user')->logout();

        return redirect()
            ->route('shop.view')
            ->with(CommonConstant::MSG, UserConstant::MSG['logout_success']);
    }


    /**
     * Show user infor function
     *
     * @return void
     */
    public function getViewUser()
    {
        $user = Auth::guard('user')->user();

        return view('shop.userinfor', [
            'user' => $user,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * update User function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(UserUpdateAccountRequest $request, $id)
    {
        $user = $this->userRepo->update($id, $request->toArray());

        return redirect()
            ->route('shop.userinfor', ['id' => $user->id])
            ->with(CommonConstant::MSG, UserConstant::MSG['update_success']);
    }



    /**
     * Show Checkout View function
     *
     * @return void
     */
    public function getViewCheckout()
    {
        $user = Auth::guard('user')->user();
        $vouchers = $this->voucherRepo->getVoucherByUser($user->id);

        if (null == $user) {
            return redirect()
                ->route('shop.login');
        } else {
            $cartItems = $this->cartItemRepo->getCartById($user->id);

            if (!$cartItems || null === $cartItems) {
                return redirect()->back();
            }

            return view('shop.checkout', [
                'vouchers' => $vouchers,
                'user' => $user,
                'cartItems' => $cartItems,
                'msg' => session()->get(CommonConstant::MSG) ?? null
            ]);
        }
    }
}
