@extends('master')

@section('main_content')
<div class="container"> 
    <div class="row mt-5 mb-3">
    <div class="col text-center">
        <h1 class="display-4">BASKET </span><i class="fas fa-basketball-ball text-danger"></i><span> WORLD</h1>
        <p class="lead">-Sign in with your account-</p>
    </div>
   </div>
   <div class="row">
       <div class="col-lg-3"></div>
       <div class="col-lg-6 m-auto">
           <form action="" method="POST" autocomplete="off" novalidate="novalidate">
               @csrf()
               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               <div class="form-group">
                   <label for="email">* Email </label>
                   <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                           <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                    <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control">
               </div>
               </div>
               <div class="form-group">
                   <label for="password">* Password </label>
                   <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                           <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <input type="password" name="password" id="password" class="form-control">
               </div>
               </div>
               <input type="submit" name="submit" value="Sign In" class="btn btn-primary">
               <span class="ml-4">Dont have an account? <a href="signup"> sign up! </a></span>
           </form>
           @if(!empty($sign_error))
           <span class="text-danger"> {{ $sign_error }} </span>
           @endif
       </div>
       <div class="col-lg-3"></div>
   </div>
</div>
@endsection
