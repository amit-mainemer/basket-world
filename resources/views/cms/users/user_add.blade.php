@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'New User'])
<div class="row">
    <div class="col-md-8">
    <form action="{{ url('cms/users') }}" method="POST" novalidate autocomplete="off" enctype="multipart/form-data">
           @csrf
        <div class="form-group">
         <label for="user_role">* User Role</label>
         <select name="user_role" id="user_role" class="form-control">
             <option value="">Choose Role...</option>
             <option value="2">User</option>
             <option value="3">Editor</option>
             <option value="1">Admin</option>
         </select>
         <span class="text-danger"> {{ $errors->first('user_role') }} </span>
        </div>
         <div class="form-group">
             <label for="name">* Name</label>
         <input type="text" name="name" id="name" class="form-control origin-text">
         <span class="text-danger"> {{ $errors->first('name') }} </span>
         </div>
         <div class="form-group">
            <label for="email">* Email</label>
         <input type="text" name="email" id="email" class="form-control">
         <span class="text-danger"> {{ $errors->first('email') }} </span>
         </div>
         <div class="form-group">
             <label for="password">* Password</label>
         <input type="password" name="password" id="password" class="form-control">
         <span class="text-danger"> {{ $errors->first('password') }} </span>
         </div>
         <div class="form-group">
            <label for="password_confirmation">* Confirm Password </label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control">
        </div>
         <div class="form-group">
            <label for="country">*  Country </label>
            <select name="country" id="country" class="form-control custom-select">
                <option value="">Choose Country...</option>
                @foreach ($countries as $country)
                  <option value="{{ $country->name }}">{{ $country->name }}</option>
                @endforeach
            </select>
            <span class="text-danger"> {{ $errors->first('country') }} </span>
        </div>
         <div class="form-group">
             <label for="image">User Image</label>
         </div>
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
         <input type="submit" class="btn btn-primary mt-3" value="Save User" name="submit">
         <a href="{{ url('cms/users') }}" class="btn btn-secondary mt-3">Cancel</a>
         </div>
     </form>
    </div>
</div>
@endsection