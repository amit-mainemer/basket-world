<?php

namespace App;

use Session;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    static public function getMostLiked(){
     $products_props = Product::pluck('id','ptitle')->toArray();
     $data = [];
     foreach($products_props as $title => $id){
       $data[$title] = self::where('product_id', $id)->count();
     }
     $data = array_filter($data, function ($val){
         return $val !== 0;
     });  
     uasort($data, function ($a, $b) {
      if ($a == $b) {
          return 0;
      }
      return ($a > $b) ? -1 : 1;
     });
     if(count($data) > 6){
     $num = 6 - count($data);
     $data = array_slice($data, 0, $num);
     }
     return $data;

    }

    static public function save_new($wid){

      if(!is_numeric($wid)) return;

      $wishlistCheckExists = self::where('user_id', Session::get('user_id'))->where('product_id', $wid)->get()->toArray();

      if($wishlistCheckExists) {
       return Session::flash('sm', 'Item already in Wishlist');
      }

      $wishlist = new self();
      $wishlist->user_id = Session::get('user_id');
      $wishlist->product_id = $wid;
      $wishlist->save();
      return Session::flash('sm', 'Item added to Wishlist');

    }

    static public function get_by_user(){
        return self::where('user_id', Session::get('user_id'))
        ->join('products as p', 'wishlists.product_id', 'p.id')
        ->leftJoin('categories as c', 'p.categorie_id', 'c.id')
        ->select('p.*', 'c.curl', 'wishlists.id as wid')
        ->get()
        ->toArray();
    }
}
