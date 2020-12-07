<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use App\Product;
use Cart;
use Session;
use App\Order;

class ShopController extends MainController
{
    public function categories(){
      self::$viewData['categories'] = Categorie::all()->toArray();
      self::$viewData['page_title'] .= 'Shop Categories';
      return view('categories', self::$viewData);
    }

    public function products($curl, Request $request){
    Product::getProducts($curl, $request, self::$viewData); 
    return view('products', self::$viewData);
    }


    public function item($curl, $purl){
        if($product = Product::where('purl', '=', $purl)->first()){
            $product->toArray();
        } else {
            abort(404);
        }
        self::$viewData['page_title'] .= $product['ptitle'];
        self::$viewData['item'] = $product;
        return view('item', self::$viewData);
        
    }

    public function addToCart(Request $request){
       Product::addToCart($request['pid']);
    }

    public function cart(){
       self::$viewData['page_title'] .= 'Shop Cart';
       $cart = Cart::getContent()->toArray();
       sort($cart);
       self::$viewData['cart'] = $cart;
       return view('cart', self::$viewData);
    }

    public function clearCart(){
       Cart::clear();
       return redirect('shop');
    }

    public function removeItem($pid){
       Cart::remove($pid);
       return redirect('shop/cart');
    }

    public function updateCart(Request $request){
       Product::updateCart($request['pid'], $request['op']);
    }

    public function checkout(){

       if(Cart::isEmpty()) return redirect('shop/cart');
       if(!Session::has('user_id')) return redirect('user/signup?rn=shop/cart');

       Order::save_new();
       return redirect('shop');
        
     }

}
