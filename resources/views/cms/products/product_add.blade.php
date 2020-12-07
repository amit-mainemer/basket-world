@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'New Product'])
<div class="row">
    <div class="col-md-8">
    <form action="{{ url('cms/products') }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
           @csrf
           <div class="form-group">
               <label for="categorie_id">Category</label>
               <select name="categorie_id" id="categorie_id" class="form-control">
                   <option value="">Choose category...</option>
                   @foreach ($categories as $category)
               <option @if(old('categorie_id') == $category['id']) selected="selected" @endif value="{{ $category['id'] }}"> {{ $category['ctitle'] }} </option>
                   @endforeach
               </select>
               <span class="text-danger"> {{ $errors->first('categorie_id') }} </span>
           </div>
            <div class="form-group">
                <label for="title">* Title</label>
            <input type="text" value="{{ old('title') }}" name="title" id="title" class="form-control origin-text">
            <span class="text-danger"> {{ $errors->first('title') }} </span>
            </div>
            <div class="form-group">
                <label for="url">* Url</label>
            <input type="text" value="{{ old('url') }}" name="url" id="url" class="form-control">
            <span class="text-danger"> {{ $errors->first('url') }} </span>
            </div>
            <div class="form-group">
                <label for="price">* Price</label>
            <input type="number" value="{{ old('price') }}" name="price" id="price" class="form-control">
            <span class="text-danger"> {{ $errors->first('price') }} </span>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="unisex">Choose gender...</option>
                    <option value="women">Women</option>
                    <option value="men">Men</option>
                    <option value="unisex">Unisex</option>

                </select>
                <span class="text-danger"> {{ $errors->first('gender') }} </span>
            </div>

            <div class="form-group">
                <label for="color">Color</label>
                <select name="color" id="color" class="form-control">
                    <option value="">Choose color...</option>
                    <option class="bg-danger text-white" value="danger">
                        red
                    </option>
                    <option class="bg-blue text-white" value="blue">
                        blue
                    </option>
                    <option class="bg-amber text-white" value="amber">
                        yellow
                    </option>
                    <option class="bg-green text-white" value="green">
                        green
                    </option>
                    <option class="bg-pink text-white" value="pink">
                        pink
                    </option>
                    <option class="bg-orange text-white" value="orange">
                        orange
                    </option>
                    <option class="bg-brown text-white" value="brown">
                        brown
                    </option>
                    <option class="bg-purple text-white" value="purple">
                        purple
                    </option>
                    <option class="bg-grey text-white" value="grey">
                        grey
                    </option>
                    <option class=" bg-black text-white" value="black">
                        black
                    </option>
                </select>
                <span class="text-danger"> {{ $errors->first('color') }} </span>
            </div>

            <div class="form-group">
                <label for="article">* Article</label>
            <textarea class="form-control" name="article" id="article" cols="30" rows="10">{{ old('article') }}</textarea>
            <span class="text-danger"> {{ $errors->first('article') }} </span>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
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
            <input type="submit" class="btn btn-primary mt-3" value="Save Product" name="submit">
            <a href="{{ url('cms/products') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection