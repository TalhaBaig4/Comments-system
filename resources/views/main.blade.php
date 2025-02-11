@extends('files.master')

@section('content')
    
        <h1>Register yourself Or Login</h1>
        <a class="btn btn-primary" href="{{url('register')}}">Register</a>
        <a class="btn btn-primary" href="{{url('login')}}">Login</a>

@endsection