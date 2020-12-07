@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Content'])
<div class="row">
    <div class="col-12">
        <p>
            <a href="{{ url('cms/content/create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
               Add Content
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
                    <th>Content Title</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($contents as $content)
                  <tr>
                  <td>{{ $content['ctitle'] }}</td>
                  <td>
                    
                  <a href="{{ url('cms/content/' . $content['id'] . '/edit') }}">
                        <i class="far fa-edit"></i> 
                          Edit  </a> | 
                        <a href="{{ url('cms/content/' . $content['id']) }}">
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