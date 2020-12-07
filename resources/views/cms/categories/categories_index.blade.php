@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Categories'])
<div class="row">
    <div class="col-12">
        <p>
            <a href="{{ url('cms/categories/create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Add Category
            </a>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div  class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category title</th>
                    <th>Category Image</th>
                    <th>last Update</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                  <tr>
                  <td>{{ $category['ctitle'] }}</td>
                  <td> <img width="80" src="{{ asset('images/' . $category['cimage']) }}" alt="" class="img-thumbnail"> </td>
                  <td> {{ date('d/m/Y', strtotime($category['updated_at'])) }} </td>
                  <td>
                    
                  <a href="{{ url('cms/categories/' . $category['id'] . '/edit') }}">
                        <i class="far fa-edit"></i> 
                        Edit</a> | 
                        <a href="{{ url('cms/categories/' . $category['id']) }}">
                            <i class="fas fa-eraser"></i>
                            Delete</a>
                  </td>
                  </tr>
              @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection