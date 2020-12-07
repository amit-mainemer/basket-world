@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Edit Product'])
<div class="row">
    <div class="col-md-8">
        <form action="{{ url('cms/products/' . $product['id']) }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off">
            @csrf
            {{ method_field('PUT') }}
             <input type="hidden" name="item_id" value="{{ $product['id'] }}" >
           <div class="form-group">
               <label for="categorie_id">Category</label>
               <select name="categorie_id" id="categorie_id" class="form-control">
                   @foreach ($categories as $category)
               <option @if( $product['categorie_id'] == $category['id']) selected="selected" @endif value="{{ $category['id'] }}"> {{ $category['ctitle'] }} </option>
                   @endforeach
               </select>
               <span class="text-danger"> {{ $errors->first('categorie_id') }} </span>
           </div>
            <div class="form-group">
                <label for="title">* Title</label>
            <input type="text" value="{{ $product['ptitle'] }}" name="title" id="title" class="form-control origin-text">
            <span class="text-danger"> {{ $errors->first('title') }} </span>
            </div>
            <div class="form-group">
                <label for="url">* Url</label>
            <input type="text" value="{{ $product['purl'] }}" name="url" id="url" class="form-control">
            <span class="text-danger"> {{ $errors->first('url') }} </span>
            </div>
            <div class="form-group">
                <label for="price">* Price</label>
            <input type="number" value="{{ $product['price'] }}" name="price" id="price" class="form-control">
            <span class="text-danger"> {{ $errors->first('price') }} </span>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="unisex">Choose gender...</option>
                    @foreach ($genders as $gender)
                   <option @if( $product['gender'] == $gender) selected="selected" @endif value="{{ $gender }}">
                     {{ $gender }}
                    </option>  
                    @endforeach

                </select>
                <span class="text-danger"> {{ $errors->first('gender') }} </span>
            </div>

            <div class="form-group">
                <label for="color">Color</label>
                <select name="color" id="color" class="form-control">
                    <option value="">Choose color...</option>
                    @foreach ($colors as $color)
                <option @if( $product['color'] == $color) selected="selected" @endif class="py-4 {{ 'bg-' . $color }}" value="{{ $color }}">
                     {{ $color }}
                    </option>  
                    @endforeach
                </select>
                <span class="text-danger"> {{ $errors->first('color') }} </span>
            </div>

            <div class="form-group">
                <label for="article">* Article</label>
            <textarea class="form-control" name="article" id="article" cols="30" rows="10">{{ $product['particle'] }}</textarea>
            <span class="text-danger"> {{ $errors->first('article') }} </span>
            </div>
            <div class="form-group">
                <label for="image">Change Product Image</label>
            </div>
        <img width="100" src="{{ asset('images/' . $product['pimage']) }}" class="img-thumbnail" alt="">
                <div class="input-group my-3">
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
            <input type="submit" class="btn btn-primary mt-3" value="Update Product" name="submit">
            <a href="{{ url('cms/products') }}" class="btn btn-secondary mt-3">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection