@extends('files.master')
@section('title', '$meta_title')
@section('meta_des', '$meta_des')
@section('content')

    <div class="text-end mt-2">
        <h2>Register yourself or Login</h2>
        <a class="btn btn-primary" href="{{url('register')}}">Register</a>
        <a class="btn btn-primary" href="{{url('login')}}">Login</a>
    </div>

    @isset($latestPost)
        <h1 class="text-center">All Blogs Post</h1> 
        <div class="col-md-8 mx-auto mt-3" id="latestblogSection">
            <div class="container p-0">
                <div class="row mx-0">
                    <h2 class="latestPostHead">{{ $latestPost->p_title }}</h2>
                    <div class="col-md-6 ps-0">
                        <img src="{{ url($latestPost->p_image) }}" width="100%" height="500px" alt="{{ $latestPost->p_title }}">
                        {{-- <img src="{{ url('https://proconcretecalculator.com/assets/imgs/blog_images/Concrete Mixing Ratios.jpg') }}" width="100%" height="500px" alt="{{ $latestPost->p_title }}"> --}}
                    </div>
                    <div class="col-md-6 pe-0">
                        <div class="latestpost">{!! ($latestPost->p_des) !!}</div>
                        <div class="col-12 p-0 margin_top_20">
                            <a class="readMore" href="{{ url('blog/' . $latestPost->p_url) }}" title="Read More">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @isset($posts)
        <div class="col-md-8 mx-auto" id="allpostSection">
            <div class="container p-0">
                <div class="row mx-0" style="gap: 15px">
                    @foreach ($posts as $key => $post)
                        <div class="col-md-4 pb-4">
                            <div class="cardPost">
                                <a class="text-decoration-none text-dark" href="{{ url('blog/' . $post->p_url) }}"
                                    title="{{ $post->p_title }}">
                                    <img src="{{ asset( $post->p_image) }}" width="100%" height="300px" alt="{{ $post->p_title }}">
                                </a>
                                <div class="cardPostBody">
                                    <p class="cardTitle">
                                        <a class="text-decoration-none text-dark" href="{{ url('blog/' . $post->p_url) }}" title="{{ $post->p_title }}">
                                            {{ \Illuminate\Support\Str::limit($post->p_title, 40, '...') }}
                                        </a>
                                    </p>
                                    <div class="col-12 p-0 margin_top_20">
                                        <a class="readMore" href="{{ url('blog/' . $post->p_url) }}" title="Read More">
                                            Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endisset

@endsection