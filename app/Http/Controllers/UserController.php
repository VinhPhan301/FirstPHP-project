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

    public function index()
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

    public function getViewCreate()
    {
        return view('user.create', [
            'msg' => session()->get(CommonConstant::MSG) ?? null
       ]);
    }

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

    public function getViewUpdate($id)
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
     * Undocumented function
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

    public function getViewLogin()
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
     * Undocumented function
     *
     * @return View
     */
    public function getViewPage() : View
    {
        return view('user.viewpage');
    }

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

    public function getLogout(Request $request) 
    {
        Auth::guard('user')->logout();
        
        return redirect('user/login');
    }

    public function getViewTest() 
    {
        return view('user.test');
    }

}
