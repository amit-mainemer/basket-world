<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Categorie;
use Illuminate\Http\Request;

class MainController extends Controller
{
    
    static public $viewData  = ['page_title' => 'basket world | '];

    public function __construct(){
        self::$viewData['menu'] = Menu::all()->toArray();
        self::$viewData['categories'] = Categorie::all()->toArray();
    }

}
