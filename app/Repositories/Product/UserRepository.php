<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Product\UserRepositoryInterface;
use Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUser()
    {
        return $this->model->select('name')->take(5)->get();
    }

    public function updateIfNull($userId, $attributes)
    {
        $user = Auth::guard('user')->user(); 
        if($user->name === null ){
            $userUpdate = $this->update($userId, ['name' => $attributes['name']]);
        }
        if ($user->phone === null){
            $userUpdate = $this->update($userId, ['phone' => $attributes['phone']]);
        }
        if ($user->address === null){
            $userUpdate = $this->update($userId, ['address' => $attributes['address']]);
        }

        return true;
    }
}
