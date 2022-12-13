<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\UserRepositoryInterface;
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

    public function __construct(ProductRepositoryInterface $productRepo, ProductDetailRepositoryInterface $productDetailRepo, UserRepositoryInterface $userRepo)
    {
        $this->productRepo = $productRepo;
        $this->productDetailRepo = $productDetailRepo;
        $this->userRepo = $userRepo;
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

            return view('shop.view',[
                'products' => $products,
                'type' => $type,
                'productList' => $productList,
                'categoryName' => null, // thua
                'msg' => session()->get(CommonConstant::MSG) ?? null
            ]);
        }

        $products = $this->productRepo->getAll();
        $productList = $this->productRepo->getProductList();

        return view('shop.view',[
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

        if ($categoryName && $type){
            
            $products = $this->productRepo->getViewCategory($type, $categoryName);

            return view('shop.view',[
                'type' => $type,
                'productList' => $products['productList'],
                'products' => $products['products'],
                'categoryName' => $categoryName,
                'msg' => session()->get(CommonConstant::MSG) ?? null
            ]);
        }

        $products = $this->productRepo->getAll();

        return view('shop.view',[
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

        return view('shop.findProduct',[
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
        $productID = $request->query('id');
        $product = $this->productRepo->find($productID);

        $relatedProducts = $this->productRepo->getRelatedProduct($productID, $product);

        $getSizeColor = $this->productDetailRepo->getSizeColor($productID);

        return view('shop.product',[
            'product' => $product,
            'detailSize' => $getSizeColor['sizeUnique'],
            'detailColor' => $getSizeColor['colorUnique'],
            'relatedProducts' => $relatedProducts,
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
        return view('shop.signup',[
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Create New Account for User function
     *
     * @param SignupFormRequest $request
     * @return void
     */
    public function createAccount(SignupFormRequest $request)
    {
        $password = Hash::make($request->password);
        $data = [
           'email' => $request->email,
           'password' => $password,
           'role' => $request->role,
        ];

        $userAccount = $this->userRepo->create($data);

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
    public function postLogin(Request $request)
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
        }

        else {
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

    public function getViewUser()
    {
        return view('shop.userinfor');
    }

    public function getStorage($productID, $color, $size)
    {
        $productDetailStorage = $this->productDetailRepo->getStorage($productID, $color, $size);

        
    }
}
