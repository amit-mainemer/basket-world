@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Users'])
<div class="row">
    <div class="col-lg-10">
        <div class="py-3" style="display: flex;">
            <div>
            <div class="input-group" id="search-div">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">
                    <i class="fas fa-search"></i>
                  </span>
                </div>
                <input type="search" id="search-bar" class="form-control" placeholder="Search Proudct" aria-label="Username" aria-describedby="basic-addon1">
              </div>
            </div>
            <div class=" pl-4">
                <a href="{{ url('cms/users/create') }}"  class="btn btn-primary ml-5">
                    <i class="fas fa-plus-circle"></i>
                    Add User
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div  class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Country</th>
                    <th>Created</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                  <tr>
                  <td width="110" class="text-center"> <img width="80" src="{{ asset('images/' . $user['image']) }}" alt="" class="img-thumbnail"> </td>
                  <td>{{ $user['name'] }}</td>
                  <td>{{ $user['email'] }} </td>
                  <td> {{ $user['country'] }} </td>
                  <td> {{ date('d/m/Y', strtotime($user['created_at'])) }} </td>
                  <td>               
                    <a href="{{ url('cms/users/' . $user['id'] . '/edit') }}">
                    <i class="far fa-edit"></i> 
                    Edit</a> | 
                    <a href="{{ url('cms/users/' . $user['id']) }}">
                        <i class="fas fa-eraser"></i>
                        Delete</a> </td>
                  </tr>
              @endforeach
            </tbody>
        </table> 
        </div>
    </div>
</div>
@endsection