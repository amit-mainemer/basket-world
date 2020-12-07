<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;


class CmsController extends MainController
{
    public function dashboard(){
       self::$viewData['orders'] = Order::getBestSeller();
       self::$viewData['wishlist'] = Wishlist::getMostLiked();
       self::$viewData['user_countries'] = User::getUserCountries();
       self::$viewData['products_categories'] = Product::getProductsCategories();
       self::$viewData['new_users'] = User::getNewUsersData();
       self::$viewData['order_dates'] = Order::getOrderDates();
       return view('cms/dashboard', self::$viewData);
    }

    public function orders(){
     
        self::$viewData['orders'] = Order::getOrders();
        return view('cms.orders.orders', self::$viewData);
        
    }
}
