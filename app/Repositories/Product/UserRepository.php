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
        if ($user->name === null) {
            $userUpdate = $this->update($userId, ['name' => $attributes['name']]);
        }
        if ($user->phone === null) {
            $userUpdate = $this->update($userId, ['phone' => $attributes['phone']]);
        }
        if ($user->address === null) {
            $userUpdate = $this->update($userId, ['address' => $attributes['address']]);
        }

        return true;
    }

    public function findIdByName($userName)
    {
        $userId = $this->model->where('name', $userName)->first()->id;

        return $userId;
    }

    public function userSuggest($search)
    {
        $userNameSplit = explode(' ', $search);
        $dataFound = $this->model->where(function ($like) use ($userNameSplit) {
            foreach ($userNameSplit as $item) {
                $like->Where('name', 'like', "%{$item}%");
            }
        })->get();
        $arrSearch = [];
        foreach ($dataFound as $item) {
            $arrSearch[] = $item->name;
        }

        return $arrSearch;
    }

    public function getUserPagination()
    {
        $users = $this->model->orderBy('created_at', 'DESC')->paginate(10, ['*'], 'np');

        return $users;
    }
}
