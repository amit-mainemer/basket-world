<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use App\BasketWorld;
use App\UserPermission;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;

class CmsUserController extends MainController
{
    public function index(Request $request)
    {
        if($request['search']){
            $term = '%' . $request['search'] . '%';
            self::$viewData['users'] = User::where('id', '>', 2)->where('name', 'LIKE', $term)->get()->toArray();
        } else {
            self::$viewData['users'] = User::where('id', '>', 2)->get()->toArray();
        }
       return view('cms.users.users_index', self::$viewData);
    }

    public function create()
    {
        self::$viewData['countries'] = BasketWorld::getCountries();
        return view('cms.users.user_add', self::$viewData);
    }

    public function store(UserRequest $request)
    {
        User::cms_save_new($request);
        return redirect('cms/users');
    }

    public function show($id)
    {
        self::$viewData['user_id'] = $id;
        return view('cms.users.user_delete', self::$viewData);
    }

    public function edit($id)
    {
        self::$viewData['countries'] = BasketWorld::getCountries();
        self::$viewData['user'] = User::where('id', $id)
        ->join('user_permissions as us', 'users.id', 'us.uid')
        ->select('users.*','us.pid as role')
        ->first()
        ->toArray();
        return view('cms.users.user_edit', self::$viewData);
    }

    public function update(UserUpdateRequest $request, $id)
    {
       User::update_user($request, $id);
       return redirect('cms/users');  
    }

    public function destroy($id)
    {
        User::destroy($id);
        UserPermission::where('uid', $id)->delete();
        Session::flash('sm', 'User has been deleted!');
        return redirect('cms/users');
    }
}
