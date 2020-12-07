<?php

namespace App;

use DB;
use Cart;
use Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    static public function save_new(){
      $cart = Cart::getContent()->toJson();
      $cart = json_decode($cart, true);
      $order = new self();
      $order->user_id = Session::get('user_id');
      $order->data = serialize($cart);
      $order->total = Cart::getTotal();
      $order->save();
      Session::flash('sm', 'Your order been saved');
      Cart::clear();
    }

    static public function getOrderDates(){
      $orders =  self::where('created_at', '>', Carbon::now()->subDays(365))->select('created_at')->get();
      $dates_data = [0,0,0,0,0,0,0,0,0,0,0,0];
      foreach($orders as $order){
        $month = Carbon::parse($order['created_at'])->format('M');
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

    static public function getBestSeller(){
      $orders = self::all();
      $orderedProducts = [];
      foreach($orders as $order){
        $orderData = unserialize($order->data);
        foreach($orderData as $data){
          if(array_key_exists($data['name'], $orderedProducts)){
            $orderedProducts[ $data['name'] ] = $orderedProducts[$data['name']] + $data['quantity'];
          }
          $orderedProducts[$data['name']] = $data['quantity'];
        }
      }
      uasort($orderedProducts, function ($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a > $b) ? -1 : 1;
       });
       if(count($orderedProducts) > 6){
        $num = 6 - count($orderedProducts);
        $orderedProducts = array_slice($orderedProducts, 0, $num);
        }
      return $orderedProducts;
    }

    static public function getOrders(){

       return DB::table('orders as o')
       ->join('users as u', 'u.id', '=', 'o.user_id')
       ->select('o.*', 'u.name')
       ->get()
       ->toArray();
    }
}
