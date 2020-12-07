@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'New Menu Link'])
<div class="row">
    <div class="col-md-8">
    <form action="{{ url('cms/menu') }}" method="POST" novalidate autocomplete="off">
           @csrf
            <div class="form-group">
                <label for="link">* Link</label>
            <input type="text" value="{{ old('link') }}" name="link" id="link" class="form-control origin-text">
            <span class="text-danger"> {{ $errors->first('link') }} </span>
            </div>
            <div class="form-group">
                <label for="url">* Url</label>
            <input type="text" value="{{ old('url') }}" name="url" id="url" class="form-control">
            <span class="text-danger"> {{ $errors->first('url') }} </span>
            </div>
            <div class="form-group">
                <label for="title">* Title</label>
            <input type="text" value="{{ old('title') }}" name="title" id="title" class="form-control">
            <span class="text-danger"> {{ $errors->first('title') }} </span>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-primary mt-3" value="Save Menu" name="submit">
            <a href="{{ url('cms/menu') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection