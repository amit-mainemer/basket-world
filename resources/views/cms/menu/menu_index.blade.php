@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Menu'])
<div class="row">
    <div class="col-12">
        <p>
            <a href="{{ url('cms/menu/create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Add Menu link
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
                    <th>Menu Link</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($menu as $item)
                  <tr>
                  <td>{{ $item['link'] }}</td>
                  <td>
                    
                  <a href="{{ url('cms/menu/' . $item['id'] . '/edit') }}">
                        <i class="far fa-edit"></i> 
                        Edit</a> | 
                        <a href="{{ url('cms/menu/' . $item['id']) }}">
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