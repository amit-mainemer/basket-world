@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Edit Menu Link'])
<div class="row">
    <div class="col-md-8">
    <form action="{{ url('cms/menu/' . $item['id']) }}" method="POST" novalidate autocomplete="off">
           {{ method_field('PUT') }} 
           <input type="hidden"name="item_id" value="{{ $item['id'] }}">
           @csrf
            <div class="form-group">
                <label for="link">* Link</label>
                @php $link_value = !empty(old('link'))? old('link') : $item['link'];  @endphp
            <input type="text" value="{{ $link_value }}" name="link" id="link" class="form-control">
            <span class="text-danger"> {{ $errors->first('link') }} </span>
            </div>
            <div class="form-group">
                <label for="url">* Url</label>
                @php $url_value = !empty(old('url'))? old('url') : $item['url'];  @endphp
            <input type="text" value="{{ $url_value }}" name="url" id="url" class="form-control">
            <span class="text-danger"> {{ $errors->first('url') }} </span>
            </div>
            <div class="form-group">
                <label for="title">* Title</label>
                @php $title_value = !empty(old('title'))? old('title') : $item['title'];  @endphp
            <input type="text" value="{{ $title_value }}" name="title" id="title" class="form-control">
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