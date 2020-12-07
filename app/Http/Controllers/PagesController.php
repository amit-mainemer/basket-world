<?php

namespace App\Http\Controllers;

use Session, DB;
use App\User;
use App\Order;
use App\Product;
use App\Content;
use App\Wishlist;
use App\BasketWorld;
use Illuminate\Http\Request;

class PagesController extends MainController
{
    public function getProfile(){
        $id = Session::get('user_id');
        self::$viewData['page_title'] .= 'Profile Page';
        self::$viewData['countries'] = BasketWorld::getCountries();
        self::$viewData['wishlist'] = Wishlist::get_by_user();
        self::$viewData['orders'] = Order::where('user_id', $id)->get();
        self::$viewData['user'] = User::find($id)->toArray();
        return view('profile', self::$viewData);
    }

    public function home(){
        $products = Product::join('categories as c', 'products.categorie_id', 'c.id')
        ->select('products.*', 'c.curl')
        ->orderBy('created_at', 'desc')
        ->limit(12)
        ->get();
        self::$viewData['page_title'] .= 'Home Page';
        self::$viewData['products'] = $products;
        return view('home', self::$viewData);
    }

    public function content($url){
        self::$viewData['contents'] = Content::getContents($url);
        self::$viewData['page_title'] .= !empty(self::$viewData['contents'][0]->title) ? 
        self::$viewData['contents'][0]->title : 'Site Content';
        return view('content', self::$viewData);
    }

    public function productsSearch($term){
       $wildCard = "%$term%";
       $products = Product::where('ptitle', 'LIKE', $wildCard )
       ->join('categories as c', 'products.categorie_id', 'c.id')
       ->select('ptitle', 'purl', 'c.curl')
       ->get()
       ->toArray();
       return response()->json($products, 200);
    }


}
