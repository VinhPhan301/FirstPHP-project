<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserUpdateRequest;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Requests\SignupFormRequest;
use App\Repositories\Product\UserRepositoryInterface;
use App\Repositories\Product\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Constants\CommonConstant;
use App\Constants\UserConstant;
use Illuminate\View\View;
use Mail;

class UserController extends Controller
{
    protected $userRepo;
    protected $orderRepo;
    protected $productRepo;

    public function __construct(
        UserRepositoryInterface $userRepo,
        OrderRepositoryInterface $orderRepo,
        ProductRepositoryInterface $productRepo,
    ) {
        $this->userRepo = $userRepo;
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
    }


    /**
     * Show User List function
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->userRepo->getUserPagination();

        if (!$users || null === $users) {
            return redirect()
                ->route('user.viewpage')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return view('user.list', [
            'user' => $users,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Show User Create Form function
     *
     * @return View
     */
    public function getViewCreate(): View
    {
        return view('user.create', [
            'msg' => session()->get(CommonConstant::MSG) ?? null
       ]);
    }


    /**
     * Create New User Account function
     *
     * @param SignupFormRequest $request
     * @return void
     */
    public function create(SignupFormRequest $request)
    {
        $password = Hash::make($request->password);
        $data = [
            UserConstant::COLUMN['name'] => $request->name,
            UserConstant::COLUMN['email'] => $request->email,
            UserConstant::COLUMN['password'] => $password,
            UserConstant::COLUMN['address'] => $request->address,
            UserConstant::COLUMN['phone'] => $request->phone,
            UserConstant::COLUMN['date_of_birth'] => $request->date_of_birth,
            UserConstant::COLUMN['role'] => $request->role,
            'status' => 'unlock'
        ];
        $user = $this->userRepo->create($data);

        if (!$user || null === $user) {
            return redirect()
                ->route('user.create')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return redirect()
            ->route('user.list')
            ->with(CommonConstant::MSG, UserConstant::MSG['create_success']);
    }


    /**
     * Delete User By ID function
     *
     * @param [type] $id
     * @return void
     */
    public function updateStatus($id)
    {
        $user = $this->userRepo->find($id);
        if ($user->status == 'unlock') {
            $userChange = $this->userRepo->update($id, ['status' => 'locked']);
        } elseif ($user->status == 'locked') {
            $userChange = $this->userRepo->update($id, ['status' => 'unlock']);
        }

        if (!$userChange || null === $userChange) {
            return redirect()
                ->route('user.list')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return redirect()
            ->route('user.list')
            ->with(CommonConstant::MSG, UserConstant::MSG['delete_success']);
    }


    /**
     * Show User Update Form By ID function
     *
     * @param [type] $id
     * @return View
     */
    public function getViewUpdate($id): View
    {
        $user = $this->userRepo->find($id);

        if (! $user || null == $user) {
            return redirect()
                ->route('user.list')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return view('user.update', ['user' => $user]);
    }


    /**
     * Update User account By ID function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $file = $request->file('avatar');
        $file->move('picture', $file->getClientOriginalName());
        $user = $this->userRepo->update($id, [
            'name' => $request->name,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'avatar' => $file->getClientOriginalName()
        ]);

        if (!$user || null === $user) {
            return redirect()
                ->route('user.list')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return redirect()
            ->route('user.list')
            ->with(CommonConstant::MSG, UserConstant::MSG['update_success']);
    }



    /**
     * User Account update role function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function updateAccountRole(Request $request, $id)
    {
        $user = $this->userRepo->update($id, $request->toArray());

        if (!$user || null === $user) {
            return redirect()
                ->route('user.list')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return redirect()
            ->route('user.list')
            ->with(CommonConstant::MSG, UserConstant::MSG['update_success']);
    }

    /**
     * Show User Login Form for ADMIN function
     *
     * @return void
     */
    public function getViewLogin()
    {
        if (Auth::guard('user')->check() == false) {
            return view('user.login', [
                'msg' => session()->get(CommonConstant::MSG) ?? null
            ]);
        } else {
            $role = Auth::guard('user')->user()->role;
            if ($role == 'admin') {
                return redirect()->route('user.viewpage');
            } else {
                return redirect()->route('shop.view');
            }
        }
    }


    /**
     * Show Admin Mainpage function
     *
     * @return View
     */
    public function getViewPage(): View
    {
        $orders = $this->orderRepo->getOrderByStatus(null, 'complete');
        $products = $this->productRepo->getAll();

        return view('user.viewpage', [
            'orders' => $orders,
            'products' => $products
        ]);
    }


    /**
     * User Login function
     *
     * @param Request $request
     * @return void
     */
    public function postLogin(LoginRequest $request)
    {
        $login = [
            UserConstant::COLUMN['email'] => $request->email,
            UserConstant::COLUMN['password'] => $request->password,
            'status' => 'unlock'
        ];

        if (auth()->guard('user')->attempt($login)) {
            $this->currentUser = auth()->guard('user')->user();
            $role = auth()->guard('user')->user()->role;

            if ($role === 'admin' || $role === 'staff' || $role === 'manager') {
                return redirect()
                    ->route('user.viewpage');
            } else {
                return redirect()
                    ->route('shop.view');
            }
        } else {
            return redirect()->back()->with('msg', UserConstant::MSG['login_fail']);
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

        return redirect()->route('user.login');
    }


    /**
     * Show view Test in Admin function
     *
     * @return View
     */
    public function getViewTest(): View
    {
        // return view('mail.order');
    }



    /**
     * Show user account in admin function
     *
     * @param [type] $id
     * @return void
     */
    public function getUserAccount($id)
    {
        $user = $this->userRepo->find($id);
        $orderCancel = $this->orderRepo->getOrderCancel($id);
        $totalPriceBought = $this->orderRepo->getBoughtTotalPrice($id);
        if (! $user || null == $user) {
            return redirect()
                ->route('user.list')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return view('user.account', [
            'boughtTotal' => $totalPriceBought,
            'cancelOrder' => $orderCancel,
            'account' => $user,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }



    public function userSearch(Request $request)
    {
        $userId = $this->userRepo->findIdByName($request->userName);

        return $userId;
    }

    public function userSearchName(Request $request)
    {
        $userNames = $this->userRepo->userSuggest($request->search);

        return $userNames;
    }
}
