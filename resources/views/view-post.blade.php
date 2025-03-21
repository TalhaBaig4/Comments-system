@extends('files.master')
@section('title', $meta_title)
@section('meta_des', $meta_des)
@section('content')
    
    @isset($posts)
        <div class="col-md-12 mx-auto" id="latestblogSection">
            <div class="container p-0">
                <div class="row mx-0">
                    <h2 class="postsHead">{{ $posts->p_title }}</h2>
                    <div class="col-md-6 ps-0">
                        <img src="{{ url( $posts->p_image) }}" width="100%" height="500px" alt="{{ $posts->p_title }}">
                    </div>
                    <div class="col-md-12 pe-0">
                        <div class="posts">{!! ($posts->p_description) !!}</div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

@endsection