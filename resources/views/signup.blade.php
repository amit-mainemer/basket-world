@extends('master')

@section('main_content')
<div class="container"> 
    <div class="row mt-5 mb-3">
    <div class="col text-center">
    <h1 class="display-4">BASKET </span><i class="fas fa-basketball-ball text-danger"></i><span> WORLD</h1>
        <p class="lead">-Sign up to basket world-</p>
    </div>
   </div>
   <div class="row">
       <div class="col-lg-3"></div>
       <div class="col-lg-6 m-auto">
           <form action="" method="POST" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
               @csrf()
               <div class="form-group my-2">
                <label for="image">User Image</label>
                  <div class="input-group mb-3 mt-2">
                    <input name="image" type='file' class="d-none" id="image-input"/>
                    <img id="image-preview" src="{{ asset('images/avatar.png') }}" class="img-thumbnail mx-auto" alt="your image" />
                  </div>
                </div>
                  <span class="text-danger"> {{ $errors->first('image') }} </span>
               <div class="form-group">
                   <label for="name">* Name </label>
                   <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                           <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input value="{{ old('name') }}" type="text" name="name" id="name" class="form-control">
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
                    <input value="{{ old('email') }}" type="email" name="email" id="email" class="form-control">
               </div>
                   <span class="text-danger"> {{ $errors->first('email') }} </span>
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
                   <span class="text-danger"> {{ $errors->first('password') }} </span>
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
                          <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div> 
                   <span class="text-danger"> {{ $errors->first('country') }} </span>
               </div>
               <input type="submit" name="submit" value="Sign up" class="btn btn-primary">
               <span class="ml-4">Already register? <a href="signin"> sign in! </a></span>
           </form>
           @if(!empty($sign_error))
           <span class="text-danger"> {{ $sign_error }} </span>
           @endif
       </div>
       <div class="col-lg-3"></div>
   </div>
</div>
@endsection
