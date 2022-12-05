<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Requests\SignupFormRequest;
use App\Repositories\Product\UserRepositoryInterface;

class UserController extends Controller
{

    protected $userRepo;
    // protected $currentUser;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
        // \View::share([ 'user' => $this->currentUser ]);
       
    }

    public function index()
    {
        $users = $this->userRepo->getAll();

        if (!$users || null === $users) {
            return redirect()->back();
        }

        return view('user.list',[
            'user' => $users,
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function getViewCreate()
    {
        return view('user.create', [
            'msg' => session()->get('msg') ?? null
       ]);
    }

    public function create(SignupFormRequest $request)
    {    
        $password = Hash::make($request->password);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'address' => $request->address,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'role' => $request->role,
        ];
        $user = $this->userRepo->create($data);

        // $userCallback = User::where('email', $request->email)->get();

        // foreach ($userCallback as $item) {
        //     $userID = $item->id;
        // }
        // $cart = Cart::create(['user_id'=> $userID]);

        if (!$user || null === $user) {
            return redirect()->back();
        }
        
        return redirect()
            ->route('user.list')
            ->with('msg', 'Tao thanh cong '.$request->role.' '.$request->name);
    }

    public function delete($id)
    {
        $user = $this->userRepo->delete($id);


        if (!$user || null === $user) {
            return redirect()->back();
        }

        return redirect()
            ->route('user.list')
            ->with('msg', 'Xoa thanh cong ');
    }

    public function getViewUpdate($id)
    {
        $user = $this->userRepo->find($id);

        if (! $user || null == $user) { 
            return redirect()
                ->route('user.list')
                ->with('msg', 'Khong tim thay user'); 
        }
       
        return view('user.update', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userRepo->update($id, $request->toArray());

        if (!$user || null === $user) {
            return redirect()->back();
        }
        
        return redirect()
            ->route('user.list')
            ->with('msg', 'Update thanh cong ');
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

    public function getViewPage()
    {
        return view('user.viewpage');
    }

    public function postLogin(Request $request)
    {

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (auth()->guard('user')->attempt($login)) {
            $this->currentUser = auth()->guard('user')->user();
            $role = auth()->guard('user')->user()->role;

            if($role == 'admin') {
                return redirect()
                    ->back();
            }
            else {
                return redirect()  
                    ->back();
            }
           
        } else {
            
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
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
