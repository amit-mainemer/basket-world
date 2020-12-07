@extends('master')

@section('main_content')
<div class="container-fluid">
    
    <div class="row">
        <div class="col-lg-10 mx-auto" >
            <div class="row">
                <div class="col my-2">
                  <div class="col-9 my-3">
                  <h2 class="font-title pl-3">News</h2>
                    </div>
                </div>
               </div>
               @foreach($contents as $content)
               <div class="card shadow mb-4">
                   <div class="card-header bg-white">
                       <h5 class="font-title py-2 m-0">{{ $content->ctitle }}</h5>
                   </div>
                   <div class="card-body">
                       <p class="card-text">{!! $content->article !!}</p>
                   </div>
               </div>          
               @endforeach
        </div>
    </div>
</div>
@endsection