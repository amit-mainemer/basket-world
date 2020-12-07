<?php

namespace App;

use Carbon\Carbon;
use App\UserPermission;
use DB, Hash, Session, Image;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    static public function validate($email, $password){
        $valid = false;

        $user = DB::table('users as u')
        ->join('user_permissions as up', 'u.id', '=', 'up.uid')
        ->join('permissions as p', 'p.id', '=', 'up.pid')
        ->select('u.*', 'p.kind', 'up.pid')
        ->where('u.email', '=', $email)
        ->first();

        if($user){

            if(Hash::check($password, $user->password)){

                $valid = true;
                Session::put('user_name', $user->name);
                Session::put('user_id', $user->id);
                Session::flash('sm', 'You are logged in!');


                if( $user->kind == 'admin' ){
                    Session::put('is_admin', true);
                }
            }
        }

        return $valid;
    }
    static public function getNewUsersData(){
        $users_dates = self::where('created_at', '>', Carbon::now()->subDays(365))->select('created_at', 'id')->get()->toArray();
        $dates_data = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($users_dates as $user_date){
          $month = Carbon::parse($user_date['created_at'])->format('M');
          if($month == 'Jan') $dates_data[0] += 1;
          if($month == 'Fab') $dates_data[1] += 1;
          if($month == 'Mar') $dates_data[2] += 1;
          if($month == 'Apr') $dates_data[3] += 1;
          if($month == 'May') $dates_data[4]  += 1;
          if($month == 'Jun') $dates_data[5] += 1;
          if($month == 'Jul') $dates_data[6] += 1;
          if($month == 'Aug') $dates_data[7] += 1;
          if($month == 'Sep') $dates_data[8] += 1;
          if($month == 'Oct') $dates_data[9] += 1;
          if($month == 'Nov') $dates_data[10] += 1;
          if($month == 'Dec') $dates_data[11] += 1;
        }
        return $dates_data;
    }

    static public function getUserCountries(){
        $users = User::all()->toArray();
        $countries = [];
        $count_users = [];
        foreach($users as $user){
         if(in_array($user['country'], $countries) && $user['id'] > 3){
            $count_users[$user['country']] = $count_users[$user['country']] + 1;
         } elseif($user['id'] > 3) {
            $countries[] = $user['country'];
            $count_users[$user['country']] = 1;
         }
        };

        $series = [];
        $labels = [];
        foreach($count_users as $country => $count){
            $series[] = $count;
            $labels[] = $country;
        }

        $data = [];
        $data[] =  $series;
        $data[] = $labels;
        return $data;
    }

    static public function changePassword($request){

        $user = self::find(Session::get('user_id'));
        if(!Hash::check($request['old_password'] , $user->password)){
            return Session::flash('sm', 'Incorrect password');
        };
        $user->password = bcrypt($request['password']);
        $user->save();
        Session::flash('sm', 'Password Updated');

    }

    static public function updateInfo($request){
       
        $user = self::find(Session::get('user_id'));
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->country = $request['country'];
        $user->save();
        Session::flash('sm', 'Info updated successfully');

    }

    static public function updateImage($request){

        $user = self::find(Session::get('user_id'));

        $image_name = $user->image;
        $ex = ['png', 'jpeg', 'jpg', 'gif', 'bmp'];

        if($request->hasFile('image') && $request->file('image')->isValid()){
            if(isset($_FILES['image']['name'])){
                $file_info = pathinfo($_FILES['image']['name']);
                if(in_array(strtolower($file_info['extension']) , $ex)){
                    if(isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
    
                        $file = $request->file('image');
                        $image_name = date('d.m.Y.H.i.s') . '-' . $file->getClientOriginalName();
                        $request->file('image')->move( public_path('/images'), $image_name);
                        $img = Image::make(public_path() . '/images/' . $image_name );
                        $img->fit(600, 600);
                        $img->save();
                    }
                }
            }
        }
        $user->image = $image_name;
        $user->save();
        Session::flash('sm', 'Image uploaded successfully');

    }


    static public function update_user($request, $id){
        
        $user = self::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];

        if($request['password']){
          $user->password = bcrypt($request['password']);
        }

        $image_name = $user->image;
        $ex = ['png', 'jpeg', 'jpg', 'gif', 'bmp'];

        if($request->hasFile('image') && $request->file('image')->isValid()){
            if(isset($_FILES['image']['name'])){
                $file_info = pathinfo($_FILES['image']['name']);
                if(in_array(strtolower($file_info['extension']) , $ex)){
                    if(isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
    
                        $file = $request->file('image');
                        $image_name = date('d.m.Y.H.i.s') . '-' . $file->getClientOriginalName();
                        $request->file('image')->move( public_path('/images'), $image_name);
                        $img = Image::make(public_path() . '/images/' . $image_name );
                        $img->fit(600, 600);
                        $img->save();
                    }
                }
            }
        }

        $user->country = $request['country'];
        $user->image = $image_name;
        $user->save();

        UserPermission::where('uid', $id)->delete();

        DB::table('user_permissions')->insert(
            ['uid' => $user->id, 'pid' => $request['user_role']]
        );

        Session::flash('sm', 'Successfully created a User');

    }

    static public function cms_save_new($request){

        $image_name = 'avater.png';
        $ex = ['png', 'jpeg', 'jpg', 'gif', 'bmp'];

        if($request->hasFile('image') && $request->file('image')->isValid()){
            if(isset($_FILES['image']['name'])){
                $file_info = pathinfo($_FILES['image']['name']);
                if(in_array(strtolower($file_info['extension']) , $ex)){
                    if(isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
    
                        $file = $request->file('image');
                        $image_name = date('d.m.Y.H.i.s') . '-' . $file->getClientOriginalName();
                        $request->file('image')->move( public_path('/images'), $image_name);
                        $img = Image::make(public_path() . '/images/' . $image_name );
                        $img->fit(600, 600);
                        $img->save();
                    }
                }
            }
        }
        
        $user = new self();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->country = $request['country'];
        $user->image = $image_name;
        $user->save();

        DB::table('user_permissions')->insert(
            ['uid' => $user->id, 'pid' => $request['user_role']]
        );
        Session::flash('sm', 'Successfully created a User');

    }

    static public function save_new($request){

      $image_name = 'avater.png';
      $ex = ['png', 'jpeg', 'jpg', 'gif', 'bmp'];
      if($request->hasFile('image') && $request->file('image')->isValid()){
          if(isset($_FILES['image']['name'])){
              $file_info = pathinfo($_FILES['image']['name']);
              if(in_array(strtolower($file_info['extension']) , $ex)){
                  if(isset($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])){
 
                      $file = $request->file('image');
                      $image_name = date('d.m.Y.H.i.s') . '-' . $file->getClientOriginalName();
                      $request->file('image')->move( public_path('/images'), $image_name);
                      $img = Image::make(public_path() . '/images/' . $image_name );
                      $img->resize(800, null, function ($constrain) {
                          $constrain->aspectRatio();
                      });
                      $img->save();
                  }
              }
          }
      }

      $user = new self();
      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->password = bcrypt($request['password']);
      $user->country = $request['country'];
      $user->image = $image_name;
      $user->save();
      DB::table('user_permissions')->insert(
          ['uid' => $user->id, 'pid' => 2]
      );
      Session::put('user_name', $user->name);
      Session::put('user_id', $user->id);
      Session::flash('sm', 'Successfully created an account!');

    }
}
