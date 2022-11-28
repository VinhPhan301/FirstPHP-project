<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{
    public function index()
    {
    //  $account = DB::select("select * from account");
        $accounts = AccountsModel::all();

      return view('welcome', ["account"=>$accounts]);
    }

    public function add(){

        return view('add');
    }

    public function save(Request $request){
       
        if($request->isMethod("post")){
            $validator = Validator::make($request->all(),[
             "name" => "required|min:6|max:12|alpha",
             "password" => "required|confirmed|min:6|max:12"
            ]);
            if($validator->fails()) {
                return redirect() -> back()
                      ->withErrors($validator)
                      ->withInput();
            }
            // else {
            //     $name = $request->get('name');
            //     $password = $request->get('password');
    
            //      AccountsModel::create([
            //         "name" => $name,
            //         "password" => $password,
            // ]);
            //     return redirect() -> to(path: "/");
            // }
            
        }
    }

   


}
