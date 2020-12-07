@extends('master')

@section('main_content')
<div class="container-fluid"> 
  <div class="row">
    <div class="col-lg-10 m-auto">
      <div class="row pt-2">
        <div class="col-9 my-3">
        <h2 class="font-title pl-3">{{ ucfirst($products[0]->ctitle) }}</h2>
        </div>
        <div class="col-2 pt-3">
          <select class="custom-select" id="product-filter">
            <option selected value="">
              Filter products
            </option>
            <option class="py-3" value="/?orderby=desc&col=price">
              <i class="fas fa-hand-holding-usd mr-2"></i>
              Price: high - low
            </option>
            <option class="py-3" value="/?orderby=asc&col=price">
              <i class="fas fa-hand-holding-usd mr-2"></i>
              Price: low - high
            </option>
            <option class="py-3" value="/?orderby=desc&col=created_at">
              <i class="fas fa-history mr-2"></i>
              Newest
            </option>
          </select>
        </div>
       </div>

       <div class="row">
        <div class="col-lg-2 col-md-2">
          <ul class="products-sidebar border-top border-bottom pl-3 py-4">
            <li>
            <a href="{{ url('shop/shirts') }}" class="font-title">
             Shirts
           </a>
            </li>
            <li>
            <a href="{{ url('shop/basketballs') }}" class="font-title">
             Basketball
           </a>
            </li>
            <li>
            <a href="{{ url('shop/shoes') }}" class="font-title">
             Shoes
           </a>
            </li>
            <li>
            <a href="{{ url('shop/hoops') }}" class="font-title">
             Hoops
           </a>
            </li>
          </ul>
          <ul class="products-sidebar border-bottom pl-3 pb-4">
            <h5 class="pb-3 font-title"><b>Gender</b></h5>
            <li>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="women">
                <label class="form-check-label" for="exampleRadios1">
                  Women
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="men">
                <label class="form-check-label" for="exampleRadios2">
                  Men
                </label>
              </div>
              <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="unisex">
                <label class="form-check-label" for="exampleRadios3">
                  unisex
                </label>
              </div>
            </li>
          </ul>
          <div class="products-sidebar border-bottom pl-3 pb-4">
            <h5 class="pb-3 font-title"><b>Color</b></h5>
            <div class="row pr-5">

              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-danger" value="danger"></div>
               </div>
              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-blue" value="blue"></div>
               </div>
              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-purple" value="purple"></div>
               </div>
              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-brown" value="brown"></div>
               </div>
              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-pink" value="pink"></div>
               </div>
              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-amber" value="amber"></div>
               </div>
              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-black" value="black"></div>
               </div>
              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-orange" value="orange"></div>
               </div>
              <div class="col-4 pb-4">
                <div class="circle mr-3 bg-grey" value="grey"></div>
               </div>

          </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-10">
            <div class="row">
        @foreach($products as $product)
            <div class="col-lg-4 col-md-6 product-col {{ $product->gender }}" @if($product->color) data-pcl="{{$product->color}}" @endif id="{{ $product->purl }}">
         <div class="card mb-4 shadow">
         <img class="img-fluid" src="{{ asset('images/' . $product->pimage) }}" alt="{{ $product->ptitle }}">
             <div class="card-body">
             <h3 class="font-title">{{ucwords($product->ptitle) }}</h3>
               <p class="card-text" style="text-transform: capitalize;">{!! $product->particle !!}</p>
               <p class="card-text">Price: <b>${{ $product->price }}</b></p>
               <div class="d-flex justify-content-between align-items-center">
                 <div class="btn-group ml-auto">
                   <a href='{{ url('shop/' . $product->curl . '/' . $product->purl )}}' 
                    class="btn btn-sm btn-primary info-btn px-3 mr-2" data-toggle="tooltip" data-placement="top" title="Info">
                    <i class="fas fa-info"></i></a>
                    @if(Session::has('user_id'))
                    <button data-wid="{{ $product->id }}" data-toggle="tooltip" data-placement="top" title="Add to wishlist" class="btn text-white wishlist circle-btn mr-2">
                      <i class="fas fa-thumbs-up"></i>
                     </button>
                    @endif
                   @if(!Cart::get($product->id))
                 <button data-pid="{{ $product->id }}" class="btn btn-danger add-to-cart" data-toggle="tooltip" data-placement="top" title="Add to cart">
                  <i class="fas fa-cart-plus"></i>
                </button>
                   @else
                   <button class="btn btn-outline-danger" disabled="disabled">Product In Cart</button> 
                   @endif
                 </div>
               </div>
             </div>
           </div>
        </div>
        @endforeach
     </div>
     </div>
    </div>
     
    </div>
  </div>


</div>
@endsection
