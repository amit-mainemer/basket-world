<?php

namespace App\Http\Controllers;

use Session;
use App\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store(Request $request){
        Wishlist::save_new($request['wid']);
    }

    public function destroy(Request $request){
        if(!is_numeric($request['wid'])) return;
        Wishlist::where('id' ,$request['wid'])->delete();
        return Session::flash('sm', 'Item removed from Wishlist');
    }
}
