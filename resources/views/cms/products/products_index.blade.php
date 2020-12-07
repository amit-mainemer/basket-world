@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Products'])
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
            <a href="{{ url('cms/products/create') }}" class="btn btn-primary ml-5">
                <i class="fas fa-plus-circle"></i>
                Add Product
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
                    <th>Product title</th>
                    <th>Product Image</th>
                    <th>Product Categorie</th>
                    <th>last Update</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                  <tr>
                  <td>{{ $product['ptitle'] }}</td>
                  <td> <img width="80" src="{{ asset('images/' . $product['pimage']) }}" alt="" class="img-thumbnail"> </td>
                  <td> Later </td>
                  <td> {{ date('d/m/Y', strtotime($product['updated_at'])) }} </td>
                  <td>
                    
                  <a href="{{ url('cms/products/' . $product['id'] . '/edit') }}">
                        <i class="far fa-edit"></i> 
                        Edit</a> | 
                        <a href="{{ url('cms/products/' . $product['id']) }}">
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