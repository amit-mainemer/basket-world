@extends('master')

@section('main_content')
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 col-12 mx-auto">
      <div class="row">
      <div class="col my-2">
        <div class="col-9 my-3">
          <h2 class="font-title pl-3">{{ $item['ptitle'] }}</h2>
          </div>
      </div>
     </div>
    
        <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6 col-md-4 text-right mb-2">
                    <img src="{{ asset('images/' . $item['pimage']) }}" class="img-thumbnail mr-auto" alt="">
                </div>
                <div class="col-lg-6 col-md-4">
                <p style="text-transform: capitalize;">{!! $item['particle'] !!}</p>
                <p>Price: <b> {{ $item['price'] }}</b></p>
                <p>Gender: <b> {{ $item['gender'] }}</b></p>
                <div class="pb-3" style="display: flex;">
                <div>Color: <b></div> <div class=" circle mx-3 mt-1 bg-{{ $item['color'] }}"></div> </b>
               </div>
                <a href="{{ url('shop/cart') }}" class="btn btn-primary circle-btn" data-toggle="tooltip" data-placement="top" title="Go to Cart" ><i class="fas fa-share"></i></a>
                 @if(!Cart::get($item->id))
                <button data-pid="{{ $item['id'] }}" class="btn btn-danger add-to-cart" data-toggle="tooltip" data-placement="top" title="Add to Cart" ><i class="fas fa-cart-plus"></i></button>
                  @else
                  <button class="btn btn-outline-danger" disabled="disabled">Product In Cart</button>
                  @endif
                </div>
            </div>
            
        </div>
    </div>
  </div>
    </div>
</div>
@endsection