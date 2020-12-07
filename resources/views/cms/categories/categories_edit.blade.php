@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'New Category'])
<div class="row">
    <div class="col-md-8">
    <form action="{{ url('cms/categories/' . $category['id']) }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
           @csrf
           {{ method_field('PUT') }}
            <input type="hidden" name="item_id" value="{{ $category['id'] }}" >
            <div class="form-group">
                <label for="title">* Title</label>
            <input type="text" value="{{ $category['ctitle'] }}" name="title" id="title" class="form-control origin-text">
            <span class="text-danger"> {{ $errors->first('title') }} </span>
            </div>
            <div class="form-group">
                <label for="url">* Url</label>
            <input type="text" value="{{ $category['curl'] }}" name="url" id="url" class="form-control">
            <span class="text-danger"> {{ $errors->first('url') }} </span>
            </div>
            <div class="form-group">
                <label for="article">* Article</label>
            <textarea class="form-control" name="article" id="article" cols="30" rows="10">{{ $category['carticle'] }}</textarea>
            <span class="text-danger"> {{ $errors->first('article') }} </span>
            </div>
            <div class="form-group">
                <label for="image">Change Categorie Image</label> <br>
               <img src="{{ asset('images/' . $category['cimage']) }}" width="100" class="img-thumbnail" alt="">
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
            <input type="submit" class="btn btn-primary mt-3" value="Save Category" name="submit">
            <a href="{{ url('cms/categories') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection