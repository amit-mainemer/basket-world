@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'New Content'])
<div class="row">
    <div class="col-md-8">
        <form action="{{ url('cms/content/' . $content['id']) }}" method="POST" novalidate autocomplete="off">
            {{ method_field('PUT') }} 
           @csrf
            <div class="form-group">
                <label for="menu-id">* Menu Link</label>
            <select class="form-control" name="menu_id" id="menu-id">
             @foreach ($menu as $item)
            <option @if( $content['menu_id']  == $item['id']) selected="selected" @endif value="{{ $item['id'] }}">{{ $item['link'] }}</option>
             @endforeach
            </select>
            <span class="text-danger"> {{ $errors->first('menu_id') }} </span>
            </div>
            <div class="form-group">
                <label for="title">* Title</label>
            <input type="text" value="{{  $content['ctitle'] }}" name="title" id="title" class="form-control">
            <span class="text-danger"> {{ $errors->first('title') }} </span>
            </div>
            <div class="form-group">
                <label for="article">* Article</label>
            <textarea class="form-control" name="article" id="article" cols="30" rows="10">{{ $content['article'] }}</textarea>
            <span class="text-danger"> {{ $errors->first('article') }} </span>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-primary mt-3" value="Update Content" name="submit">
            <a href="{{ url('cms/content') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection