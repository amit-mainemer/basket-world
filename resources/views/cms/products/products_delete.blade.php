@extends('cms.cms_master')
@section('cms_content')
@include('utils.cms_header', ['title' => 'Delete Product'])
<div class="row">
    <div class="col-md-8">
    <form action="{{ url('cms/products/' . $item_id) }}" method="POST">
            {{ method_field('DELETE') }}       
            @csrf
           <h4>Are you sure you want to delete this Categorie?</h4>
           <input type="submit" value="DELETE" class="btn btn-danger" name="submit">
           <a href="{{ url('cms/products') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection