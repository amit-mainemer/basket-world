@extends('master')

@section('main_content')
<div class="container-fluid"> 
    <div class="row">
          <div class="col-lg-10 mx-auto" >
            <div class="row pt-2">
               <div class="col-4 font-title my-3">
                   <h2 class="font-title pl-3">My Profile</h2>
               </div>
            </div>
            <div class="row">
                  <div class="col-lg-6">
                    <div class="card mb-4 shadow">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <div class="img-container">
                                    <form class="text-center mx-auto" action="{{ url('user/profile/image') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
                                     @csrf
                                     {{ method_field('PUT') }}
                                    <img src="{{ asset('images/' . $user['image']) }}" class="img-thumbnaill my-3" 
                                    style="border: 4px double rgb(156, 156, 156); width: 80%; border-radius: 50%;"
                                    alt="profile-picture"
                                    id="profile-picrute"
                                    data-toggle="tooltip" 
                                    data-placement="bottom"
                                    title="Change Picture">
                                    <input name="image" type='file' class="d-none" id="image-profile-input"/>
                                    <input type="submit" class="d-none" id="image-btn" value="Update User" name="submit">
                                    </form>
                                </div>
                            </div>
                          <div class="col-md-8">
                              <div class="card-body" style="height: 100%;">
                                  <div class="card-title">
                                      <h5> My Info</h5>
                                  </div>
                                <div class="pb-2"><i class="fas fa-user mr-2 text-primary"></i> {{ $user['name'] }}</div>
                                <div class="pb-2"><i class="fas fa-envelope mr-2 text-primary"></i> {{ $user['email'] }}</div>
                                <div class="pb-2"><i class="fas fa-globe-americas mr-2 text-primary"></i> {{ $user['country'] }}</div>
                                <div class="card-actions text-right">
                                    <button class="btn btn-primary mr-2 circle-btn"
                                     data-toggle="modal" 
                                     data-target="#exampleModalCenter">
                                        <i class="fas fa-edit"      
                                        data-toggle="tooltip" 
                                        data-placement="top"
                                        title="Edit info" ></i>
                                    </button>
                                    <button class="btn btn-danger text-white circle-btn" data-toggle="modal" data-target="#change-pass">
                                        <i class="fas fa-unlock-alt"
                                        data-toggle="tooltip" 
                                        data-placement="top"
                                        title="Change Password"></i>
                                    </button>
                                </div>
                             </div>
                        </div>
                      </div>
                  </div>
                  </div>
                      <div class="col-lg-6">
                          <div class="card shadow mb-4" style="height: 92%!important;">
                              <div class="card-body pb-0">
                                  <div class="card-title">
                                    <h5 class="pl-3">
                                        Wishlist
                                    </h5>
                                  </div>
                                  @if(count($wishlist))
                                  <div class="glider-contain multiple">
                                      <button class="glider-prev" style="outline: none;">
                                        <i class="fas fa-chevron-left wish-arrow"></i>
                                      </button>
                                      <div class="glider pb-3 pt-2">
                                          @foreach ($wishlist as $item)
                                          <div class="card mx-2 shadow-sm wish-card"   
                                          data-toggle="modal" 
                                          data-target="#{{$item['purl']}}"
                                          style="max-width: 170px;">
                                          <img class="card-img-top"    
                                          data-toggle="tooltip" 
                                          data-placement="bottom"
                                          title="View item"  src="{{ asset('images/' . $item['pimage']) }}" alt="">
                                          <div class="card-body p-2">
                                          <p class="card-text font-title">{{ $item['ptitle'] }}</p>
                                          </div>
                                          </div>
                                          @endforeach
                                      </div> 
                                      <button class="glider-next" style="outline: none;">
                                        <i class="fas fa-chevron-right wish-arrow"></i>
                                    </button>
                                  </div>
                                  @else
                                  <span>No Wishlist items at the moment...</span>
                                  @endif
                              </div>
                          </div>
                      </div>
                    </div>
             <div class="row">
                 <div class="col-12">
                    <div class="card shadow mt-4 p-0">
                        <div class="card-body">
                           <div class="card-title">
                             <h4 class="my-2 pl-2 pb-3">
                                My Orders
                            </h4>  
                            </div>
                            @if(count($orders))
                            <div  class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#Number</th>
                                        <th>Order</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                        <td style="width: 140px">{{ $order->id }}</td>
                                        <td>
                                            <ul class="list-group">
                                                @foreach (unserialize($order->data) as $item)
                                                  <li class="list-group-item border-primary">
                                                      <b>{{ $item['name'] }}</b><br>
                                                      Quantity: {{ $item['quantity'] }} <br>
                                                      Price: {{ $item['price'] }}$ 
                                                 </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $order->total }}$</td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                            @else
                                  <span> <i>No orders at the moment...</i> </span>
                            @endif

                        </div>
                    </div>
                 </div>
             </div>
          </div>
        </div>
      </div>
     </div>
    {{-- Wishlist Modal --}}
    @if(count($wishlist))
    @foreach ($wishlist as $item)
    <div class="modal fade" id="{{ $item['purl'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"" style="width: 502px" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
                <img src="{{ asset('images/' . $item['pimage']) }}" style="width: 100%;" alt="">
                <div class="p-4">
                 <h3 class="font-title">{{ucwords($item['ptitle']) }}</h3>
                 <p class="card-text" style="text-transform: capitalize;">{!! $item['particle'] !!}</p>
                 <p class="card-text">Price: <b>${{ $item['price'] }}</b></p>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group ml-auto">
                    <a href='{{ url('shop/' . $item['curl'] . '/' . $item['purl'] )}}' 
                     class="btn btn-sm btn-primary info-btn px-3 mr-2" data-toggle="tooltip" data-placement="top" title="Info">
                     <i class="fas fa-info"></i>
                    </a>
                     <button data-wid="{{ $item['wid'] }}" 
                        data-toggle="tooltip" 
                        data-placement="top" title="Remove from wishlist" class="btn text-white wish-remove circle-btn mr-2">
                        <i class="fas fa-thumbs-down"></i>
                    </button>
                    @if(!Cart::get( $item['id']))
                  <button data-pid="{{ $item['id'] }}" class="btn btn-danger add-to-cart" data-toggle="tooltip" data-placement="top" title="Add to cart">
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
    @endif
     {{-- Edit Modal --}}
     <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit Info</h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('user/info')}}" method="POST" novalidate autocomplete="off">
                @csrf
                {{ method_field('PUT') }}
                <input type="number" name="id" class="d-none" value="{{ $user['id'] }}">
                <div class="form-group">
                    <label for="name">* Name </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                               <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <input value="{{ $user['name'] }}" type="text" name="name" id="name" class="form-control">
                    </div>
                    <span class="text-danger"> {{ $errors->first('name') }} </span>
                </div>
                <div class="form-group">
                    <label for="email">* Email </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                               <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        <input value="{{ $user['email'] }}" type="email" name="email" id="email" class="form-control">
                    </div>
                    <span class="text-danger"> {{ $errors->first('email') }} </span>
                </div>
                <div class="form-group pb-2">
                    <label for="country">* Your Country </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                               <i class="fas fa-globe-americas"></i>
                            </span>
                        </div>
                    <select name="country" id="country" class="form-control">
                        <option value="">Choose Country...</option>
                        @foreach ($countries as $country)
                          <option @if( $user['country'] == $country->name) selected="selected" @endif value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                    <span class="text-danger"> {{ $errors->first('country') }} </span>
                </div>
                <button type="submit" class="d-none" id="user-info-btn" name="submit"></button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="modal-info" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

     {{-- Change Password Modal --}}
     <div class="modal fade" id="change-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white" id="exampleModalLongTitle">Change Password</h5>
            </div>
            <div class="modal-body">
                <form action="{{ url('user/change/pass')}}" method="POST" novalidate autocomplete="off">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group">
                    <label for="password">* Password </label>
                    <div class="input-group mb-3">
                     <div class="input-group-prepend">
                         <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-key"></i>
                         </span>
                     </div>
                    <input type="password" name="old_password" id="old-password" class="form-control">
                </div>
                @if (isset($errors) && count($errors))
                <span class="text-danger"> {{ $errors->first('old_password') }} </span>
                @endif
                </div>
                <div class="form-group">
                    <label for="password">* New Password </label>
                    <div class="input-group mb-3">
                     <div class="input-group-prepend">
                         <span class="input-group-text" id="basic-addon1">
                            <i class="fas fa-key"></i>
                         </span>
                     </div>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                @if (isset($errors) && count($errors))
                    <span class="text-danger"> {{ $errors->first('password') }} </span>
                @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation">* Confirm Password </label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                           <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <input type="password" name="password_confirmation" id="password-confirmation" class="form-control">
                </div>
                </div>
                <button type="submit" class="d-none" id="user-pass-btn" name="submit"></button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="modal-pass" class="btn btn-primary">Change Password</button>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>
@endsection
