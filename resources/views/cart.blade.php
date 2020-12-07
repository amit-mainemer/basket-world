@extends('master')

@section('main_content')
<div class="container"> 
    <div class="row mt-4">
        <div class="col-lg-8">
            <h2 class="font-title">Shopping Cart</h2>
            <ul class="list-group list-group-flush mt-3">
                @foreach($cart as $item)
                <li class="list-group-item border-top-0">
                    <div class="row border-bottom">
                     <div class="col-4 mb-4">
                     <img class="img-thumbnail mr-2" src="{{ asset('images/' . $item['attributes']['image']) }}" width="300" alt="{{ $item['name'] }}">
                     </div>
                     <div class="col-8">
                     <h5>{{ $item['name'] }}</h5>
                     <p> {{ $item['attributes']['article'] }} </p>
                     <div class="mt-5">
                        <a data-op="plus" data-pid="{{ $item['id'] }}" class="update-cart-btn" href="#">+</a>
                        <input size="1" type="text" value="{{ $item['quantity'] }}" class="text-center">  
                        <a data-op="minus" data-pid="{{ $item['id'] }}" class="update-cart-btn" href="#">-</a>
                        <b class="ml-3">Price: </b> ${{  $item['price'] }} 
                        <b class="ml-3">Sub Total: </b> ${{  $item['price'] * $item['quantity'] }} 
                        <a href="{{ url('shop/remove-item/' . $item['id']) }}" class="text-secondary float-right remove-item-btn"><i class="fas fa-trash-alt"></i></a>
                     </div>
                     
                     </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-4">
            <h2 class="font-title">Summary</h2>
            <div class="row mt-3">
                <div class="col-12">
                    <p>Delivery & handling:  $0</p>
                    <div class="my-3 p-2 border-top border-bottom">
                        <h5><b>Total: </b> ${{ Cart::getTotal() }}</h5>
                    </div>
                        
                        </p>
                            <a href="{{ url('shop/checkout') }}" class="btn btn-success">
                                CHECKOUT
                            </a>
                            <span class="flaot-right ml-5 pl-5">
                                <a href="{{ url('shop/clear-cart') }}" class="btn btn-light"> Clear Cart </a>
                            </span>
                        </p>
                        
                </div>
            </div>
        </div>
    </div>
  {{--   <div class="row my-4">
    <div class="col text-center">
    <h1 class="display-4">Shopping Cart </h1>
    <p class="lead">This is what we belive in</p>
    </div>
   </div>
   <div class="row">
       <div class="col-12">
     <table class="table table-bordered">
         <thead>
             <tr class="text-center">
                 <th>Product</th>
                 <th>Quantity</th>
                 <th>Price</th>
                 <th>Sub Total</th>
                 <th></th>
             </tr>
         </thead>
         <tbody>
             @foreach ($cart as $item)
             <tr>
                 <td>
                 <img class="img-thumbnail mr-2" src="{{ asset('images/' . $item['attributes']['image']) }}" width="100" alt="">
                      {{ $item['name'] }}
                 </td>
                <td class="text-center">
                    <a data-op="plus" data-pid="{{ $item['id'] }}" class="update-cart-btn" href="#">+</a>
                    <input size="1" type="text" value="{{ $item['quantity'] }}" class="text-center">  
                    <a data-op="minus" data-pid="{{ $item['id'] }}" class="update-cart-btn" href="#">-</a>
                </td>
                <td>${{ $item['price'] }}</td>
                <td>${{ $item['price'] * $item['quantity'] }}</td>
                <td class="text-center">
                    <a href="{{ url('shop/remove-item/' . $item['id']) }}" class="text-secondary remove-item-btn"><i class="fas fa-trash-alt"></i></a>
                </td>

             </tr>
             @endforeach
         </tbody>
     </table>
     <p>
     <b>Total: </b> ${{ Cart::getTotal() }}
     <span class="flaot-right">
         <a href="{{ url('shop/clear-cart') }}" class="btn btn-light"> Clear Cart </a>
     </span>
     </p>
     <p>
         <a href="#" class="btn btn-primary btn-lg">
             ORDER NOW
         </a>
     </p>
   </div>
</div> --}}
</div>
@endsection