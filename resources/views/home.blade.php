@extends('master')

@section('main_content')
<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
    <div class="col-12 text-center m-0 p-0">
      <div class="wrap-video" style="position:relative;">
      <video class="video-fluid" autoplay loop muted style="width: 100%; position: relative; z-index: 10;">
      <source id="home-video" src="{{ asset('images/niki-flip.mp4') }}" type="video/mp4">
      </video>
        <div class="shadow-lg home-video-box">
        <p>
          <h1 class="font-title pb-5 text-left home-header"> <span class="pb-5 pr-4"> Gear up with </span><br> <span class="pl-5 ml-5 text-right"> Basket World</span></h1>
          <p style="width: 70%;" class="text-left pb-5"> Lorem ipsum dolor,
             sit amet consectetur adipisicing elit. Totam, minus eius. Provident tempora ducimus explicabo, 
             fugit ipsam eligendi in eius inventore animi. Deleniti ipsum quibusdam sed exercitationem! </p>
          <a class="btn btn-danger btn-lg mb-2 px-5" href="{{ url('shop') }}">
            Our Shop
          </a>
        </p>
      </div>
    </div>
    </div>
    </div>
    <div class="row m-0 my-5">
    <div class="col-12">
      <h3 class="font-title pl-5">View some of our products</h3>
    </div>
    </div>
    <div class="row m-0  pr-2">
      <div class="glider-contain multiple" style="width: 90%!important;">
        <button class="glider-prev" style="outline: none;">
          <i class="fas fa-chevron-left wish-arrow"></i>
        </button>
        <div class="glider pb-3 pt-2">
            @foreach ($products as $product)
            <div class="card mb-4 shadow mx-3">
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
            @endforeach
          </div>
        <button class="glider-next" style="outline: none;">
          <i class="fas fa-chevron-right wish-arrow"></i>
        </button>
    </div>
    </div>
  </div>
@endsection
