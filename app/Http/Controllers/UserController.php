<?php

namespace App\Http\Controllers;

use Curl;
use Session;
use App\User;
use App\BasketWorld;
use Illuminate\Http\Request;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UserInfoRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserImageRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends MainController
{

    public function updatePassword(PasswordRequest $request){
        User::changePassword($request);
        return redirect('user/profile');
    }

    public function updateProfileImage(UserImageRequest $request){
        User::updateImage($request);
        return redirect('user/profile');
    }

    public function updateProfileInfo(UserInfoRequest $request){ 
        if( Session::get('user_id') !== (int)$request['id']) return redirect('user/profile');
        User::updateInfo($request);
        return redirect('user/profile');
    }

    public function getSignin(){
       self::$viewData['page_title'] .= 'Signin';
       return view('signin', self::$viewData);
    }

    public function postSignin(SigninRequest $request){

        if(User::validate($request['email'], $request['password'])){
            return redirect('user/profile');
        } else {
            self::$viewData['page_title'] .= 'Signin';
            self::$viewData['sign_error'] = ' * Wrong email or password';
            return view('signin', self::$viewData);
        }
    }

    public function logout(Request $request){
        $request->session()->forget(['user_id', 'user_name', 'is_admin']);
        return redirect('user/signin');
    }

    public function getSignup(){

        self::$viewData['page_title'] .= 'Signup';
        self::$viewData['countries'] = BasketWorld::getCountries();
        return view('signup', self::$viewData);
    }

    public function postSignup(SignupRequest $request){
       User::save_new($request);
       $rn = !empty($request['rn'])? $request['rn']: '';
       return redirect($rn);
       
    }
}
