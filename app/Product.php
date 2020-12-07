<?php

namespace App;

use DB;
use Cart;
use Image;
use Session;
use App\Categorie;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

   static public function getProductsCategories(){
     $cats_props = Categorie::pluck('id','ctitle')->toArray();
     $series = [];
     $labels = [];
     foreach($cats_props as $title => $id){
       $series[] = self::where('categorie_id', $id)->count();
       $labels[] = $title;
     }
     $data = [];
     $data[] = $series;
     $data[] = $labels;
     return $data;
   }
   
   static public function getProducts($curl, $request, &$viewData){

    $products = DB::table('products as p')
    ->join('categories as c', 'c.id', '=' ,'p.categorie_id')
    ->select('p.*', 'c.ctitle', 'c.curl')
    ->where('c.curl', '=', $curl);

    if($request['orderby'] && $request['col']){

    $products->orderBy($request['col'], $request['orderby']);
    
   }

   $products = $products->get()->toArray();

    if(count($products) == 0){
      abort(404);
    }

    $viewData['products'] =  $products;
    $viewData['page_title'] .= $products[0]->ctitle;
   }

   static public function addToCart($pid){
    if(is_numeric($pid)){

      if($product = self::find($pid)){

        $product = $product->toArray();

        if(!Cart::get($pid)){
          Cart::add($pid, $product['ptitle'], $product['price'], 1, ['image' => $product['pimage'], 'article' => $product['particle']]);
          Session::flash('sm','Item added to cart!' );
         };
      }
    }
   }

   static public function updateCart($pid, $op){
    
    if(is_numeric($pid)){

      if(Cart::get($pid)){

        if($op == 'minus' ){

          Cart::update($pid, [ 'quantity' => -1 ]);

        } elseif($op == 'plus'){

          Cart::update($pid, [ 'quantity' => 1 ]);

        }

      }

    }

   }

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

    $product = new self(); 
    $product->categorie_id =  $request['categorie_id']; 
    $product->ptitle =  $request['title']; 
    $product->particle =  $request['article']; 
    $product->purl =  $request['url']; 
    $product->price =  $request['price']; 
    $product->gender =  $request['gender'];
    if($request['color']){
      $product->color =  $request['color']; 
    }
    $product->pimage =  $image_name;
    $product->save();
    Session::flash('sm', 'Product Saved!');
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
    
      $product = self::find($id); 
      $product->categorie_id =  $request['categorie_id']; 
      $product->ptitle =  $request['title']; 
      $product->particle =  $request['article']; 
      $product->purl =  $request['url']; 
      $product->price =  $request['price']; 
      $product->gender =  $request['gender'];
      if($request['color']){
        $product->color =  $request['color']; 
      }
      if($image_name){
        $product->pimage =  $image_name;
      }
      $product->save();
      Session::flash('sm', 'Product Updated!');
    
    }

}
