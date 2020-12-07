@php
  $menu = App\Menu::all()->toArray();  
@endphp
@extends('master')

@section('main_content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12 text-center">
                  <h1 class="font-title"><i class="fas fa-exclamation-circle"></i> OOPS The page is not found</h1>
                  <p class="lead">- Error 404 -</p>  
        </div>
    </div>
</div>
@endsection