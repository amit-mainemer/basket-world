<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Categorie;
use Session;

class ProductsController extends MainController
{
    public function index(Request $request)
    {
        if($request['search']){
            $term = '%' . $request['search'] . '%';
            self::$viewData['products'] = Product::where('ptitle', 'LIKE', $term)->get()->toArray();
        } else {
            self::$viewData['products'] = Product::all()->toArray();
        }
       return view('cms.products.products_index', self::$viewData);
    }

    public function create()
    {
        self::$viewData['categories'] = Categorie::all()->toArray();
        return view('cms.products.product_add', self::$viewData);
    }

    public function store(ProductRequest $request)
    {
        Product::save_new($request);
        return redirect('cms/products');
    }

    public function show($id)
    {
        self::$viewData['item_id'] = $id;
        return view('cms.products.products_delete', self::$viewData);
    }

    public function edit($id)
    {
        self::$viewData['colors'] = [
            'danger' , 'blue', 'green', 'brown', 'purple' , 'orange', 'amber', 'pink', 'black', 'grey',
        ];
        self::$viewData['genders'] = [
            'unisex', 'women', 'men',
        ];
        self::$viewData['categories'] = Categorie::all()->toArray();
        self::$viewData['product'] = Product::find($id)->toArray();
        return view('cms.products.products_edit', self::$viewData);
    }

    public function update(ProductRequest $request, $id)
    {
       Product::update_item($request, $id);
       return redirect('cms/products');  
    }

    public function destroy($id)
    {
        Product::destroy($id);
        Session::flash('sm', 'Product has been deleted!');
        return redirect('cms/products');
    }
}
