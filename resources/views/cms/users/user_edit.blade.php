@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Edit User'])
<div class="row">
    <div class="col-md-8">
    <form action="{{ url('cms/users/' . $user['id']) }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}
        <div class="form-group">
         <label for="user_role">* User Role</label>
         <select name="user_role" id="user_role" class="form-control">
             <option value="">Choose Role...</option>
             <option @if( $user['role'] == 2) selected="selected" @endif value="2">User</option>
             <option @if( $user['role'] == 3) selected="selected" @endif value="3">Editor</option>
             <option @if( $user['role'] == 1) selected="selected" @endif value="1">Admin</option>
         </select>
         <span class="text-danger"> {{ $errors->first('user_role') }} </span>
        </div>
         <div class="form-group">
             <label for="name">* Name</label>
         <input type="text" value="{{ $user['name'] }}" name="name" id="name" class="form-control origin-text">
         <span class="text-danger"> {{ $errors->first('name') }} </span>
         </div>
         <div class="form-group">
            <label for="email">* Email</label>
         <input type="text" value="{{ $user['email'] }}" name="email" id="email" class="form-control">
         <span class="text-danger"> {{ $errors->first('email') }} </span>
         </div>
         <div class="form-group">
             <label for="password">Password</label>
         <input type="password" name="password" id="password" class="form-control">
         <span class="text-danger"> {{ $errors->first('password') }} </span>
         </div>
         <div class="form-group">
            <label for="password_confirmation">Confirm Password </label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control">
        </div>
         <div class="form-group">
            <label for="country">*  Country </label>
            <select name="country" id="country" class="form-control custom-select">
                <option value="">Choose Country...</option>
                @foreach ($countries as $country)
                  <option @if( $user['country'] == $country->name) selected="selected" @endif value="{{ $country->name }}">{{ $country->name }}</option>
                @endforeach
            </select>
            <span class="text-danger"> {{ $errors->first('country') }} </span>
        </div>
         <div class="form-group">
             <label for="image">User Image</label>
         </div>
         <img width="100" src="{{ asset('images/' . $user['image']) }}" class="img-thumbnail mb-3" alt="">
             <div class="input-group mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                 </div>
                 <div class="custom-file">
                   <input name="image" type="file" class="custom-file-input" id="image">
                   <label class="custom-file-label" for="image">Choose file</label>
                 </div>
               </div>
               <span class="text-danger"> {{ $errors->first('image') }} </span>
         <div class="form-group">
         <input type="submit" class="btn btn-primary mt-3" value="Update User" name="submit">
         <a href="{{ url('cms/users') }}" class="btn btn-secondary mt-3">Cancel</a>
         </div>
     </form>
    </div>
</div>
@endsection