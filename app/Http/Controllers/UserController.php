<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Requests\SignupFormRequest;
use App\Repositories\Product\UserRepositoryInterface;
use App\Constants\CommonConstant;
use App\Constants\UserConstant;
use Illuminate\View\View;

class UserController extends Controller
{

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;    
    }


    /**
     * Show User List function
     *
     * @return View
     */
    public function index() : View
    {
        $users = $this->userRepo->getAll();

        if (!$users || null === $users) {
            return redirect()
                ->route('user.viewpage')
                ->with(CommonConstant::MSG, UserConstant::MSG['not_found']);
        }

        return view('user.list',[
            'user' => $users,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Show User Create Form function
     *
     * @return View
     */
    public function getViewCreate() : View
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
    public function delete($id)
    {
        $user = $this->userRepo->delete($id);

        if (!$user || null === $user) {
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
    public function getViewUpdate($id) : View
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
    public function update(Request $request, $id)
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
     * @return View
     */
    public function getViewLogin() : View
    {  
        if(Auth::guard('user')->check() == false){
            return view('user.login');
        }
        else{
            $role = Auth::guard('user')->user()->role;
            if($role == 'admin'){
                return redirect()->route('user.viewpage');
            }
            else{
                return redirect()->route('shop.view');
            }
        }
    }


    /**
     * Show Admin Mainpage function
     *
     * @return View
     */
    public function getViewPage() : View
    {
        return view('user.viewpage');
    }


    /**
     * User Login function
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
            $role = auth()->guard('user')->user()->role;

            if ( $role == 'admin' ) {
                return redirect()
                    ->route('user.viewpage');
            }
            else {
                return redirect()  
                    ->route('shop.view');
            }
           
        } else {
            
            return redirect()->back()->with('status', UserConstant::MSG['login_fail']);
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
        
        return redirect('user/login');
    }


    /**
     * Show view Test in Admin function
     *
     * @return View
     */
    public function getViewTest() : View
    {
        return view('user.test');
    }

}
