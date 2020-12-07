@extends('master')

@section('main_content')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-10 mx-auto">
    <div class="row">
    <div class="col my-2">
      <div class="col-9 my-3">
        <h2 class="font-title pl-3">Our Shop</h2>
        </div>
    </div>
   </div>
   <div class="row">
       @if($categories)
       
       @foreach ($categories as $category)
           <div class="col-lg-6 col-md-6 col-10 mx-auto">
            <div class="card mb-5 mx-auto shadow" style="max-width: 650px;">
                <div class="row no-gutters">
                  <div class="col-md-8">
                      <div class="card-header bg-white py-2">
                        <h5 class="card-title font-title align-middle m-auto py-2"><b>{{ $category['ctitle'] }}</b></h5>
                      </div>
                    <div class="card-body">
                      <p class="card-text">{!! $category['carticle'] !!}</p>
                    <a class="btn btn-primary" href="{{ url('shop/' . $category['curl'] ) }}" class="streched-link">View Proudcts</a>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <img style="height:100%; max-height: 300px;" src="{{ asset('images/' . $category['cimage']) }}" class="card-img img-fluid" alt="{{ $category['ctitle'] }}">
                  </div>
                </div>
              </div>
           </div>
       @endforeach
       @else
       <div class="col">
           <span>no categories available...</span>
       </div>
       @endif
   </div>
  </div>
  </div>
</div>
@endsection
