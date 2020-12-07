@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Dashboard'])
<div class="row">
<div class="col-lg-3 col-md-6">
    <div class="card text-center bg-success shadow-lg card-icon">
    <i class="fas fa-award fa-3x text-white"></i>
    </div>
    <div class="card shadow my-4">
        <div class="card-header bg-white low-card py-4">
            <h5 class="m-0 font-title" style="padding-left: 80px;">Best Seller</h5>
        </div>
       
        @if(count($orders))
        @foreach ($orders as $key => $num)
        <ol class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action" style="font-size: 1.1em">
              <b>{{ $key }}</b> 
            <div class="mr-auto text-right float-right pr-2">
              <b>{{ $num }}</b>  
            </div>
            </li>
          </ol>
        @endforeach
        @endif
      </div>
</div>
<div class="col-lg-3 col-md-6">
  <div class="card text-center bg-amber shadow-lg card-icon">
    <i class="fas fa-thumbs-up text-white fa-3x"></i>
</div>
   <div class="card shadow my-4">
    <div class="card-header bg-white low-card py-4">
        <h5 class="m-0 font-title" style="padding-left: 80px;">Wishlist Top</h5>
    </div>
    @if(count($wishlist))
    @foreach ($wishlist as $key => $num)
    <ol class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action" style="font-size: 1.1em">
          <b>{{ $key }}</b> 
        <div class="mr-auto text-right float-right pr-2">
          <b>{{ $num }}</b>  
        </div>
        </li>
      </ol>
    @endforeach
    @endif
   </div>
   
</div>
<div class="col-lg-3 col-md-6">

  <div class="card text-center bg-primary shadow-lg card-icon">
    <i class="fas fa-globe-americas text-white fa-3x"></i>
    </div>
       <div class="card shadow my-4">
        <div class="card-header bg-white low-card py-4">
            <h5 class="m-0 font-title" style="padding-left: 80px;">Users Countries</h5>
        </div>
           <div id="chart-pie"></div>

       </div>

</div>
<div class="col-lg-3 col-md-6">
  <div class="card text-center bg-pink shadow-lg card-icon">
    <i class="fas fa-shopping-cart fa-3x text-white"></i>
      </div>
         <div class="card shadow my-4">
          <div class="card-header bg-white low-card py-4">
              <h5 class="m-0 font-title" style="padding-left: 80px;">Products per catagories</h5>
          </div>
             <div id="chartbar" ></div>
      </div>
</div>
</div>
    <div class="row">
      <div class="col-lg-6">
        <div class="card px-4 text-center bg-info shadow-lg card-icon">
            <i class="fas fa-users text-white fa-3x"></i>
            </div>
               <div class="card shadow my-4" >
                <div class="card-header bg-white low-card py-4">
                    <h5 class="m-0 font-title" style="padding-left: 80px;">New Users</h5>
                </div>
                
                <div id="chart-users" style="width: 95%;"></div>
                   {{-- <div id="chart-users" style="width: 95%;"></div> --}}
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card px-4 text-center bg-success shadow-lg card-icon">
           <i class="fas fa-hand-holding-usd fa-3x text-white"></i>
            </div>
               <div class="card shadow my-4">
                <div class="card-header bg-white low-card py-4">
                    <h5 class="m-0 font-title" style="padding-left: 80px;">Orders</h5>
                </div>
                <div id="chart" style="height: 200px;width: 95%;"></div>
            </div>
      </div>
    </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script> 
  let userCountries = {!! json_encode($user_countries) !!};
  let productsCategories = {!! json_encode($products_categories) !!};
  let newUsers = {!! json_encode($new_users) !!};
  let orderDates = {!! json_encode($order_dates) !!};
</script>
<script src="{{ asset('js/charts.js') }}"></script>

@endsection