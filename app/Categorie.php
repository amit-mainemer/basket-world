<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Image;

class Categorie extends Model
{
    static public function save_new($request){

        $image_name = 'default-landscape.jpg';
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

        $categorie = new self(); 
        $categorie->ctitle =  $request['title']; 
        $categorie->carticle =  $request['article']; 
        $categorie->curl =  $request['url']; 
        $categorie->cimage =  $image_name;
        $categorie->save();
        Session::flash('sm', 'Categorie Saved!');
    }

    static public function update_item($request, $id){

        $image_name = '';
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

        $categorie = self::find($id); 
        $categorie->ctitle =  $request['title']; 
        $categorie->carticle =  $request['article']; 
        $categorie->curl =  $request['url']; 
        if($image_name){
          $categorie->cimage  = $image_name;
        }
        $categorie->save();
        Session::flash('sm', 'Categorie Updated!');

    }
}
