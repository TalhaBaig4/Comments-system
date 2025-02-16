@extends('Files.master')
@section('content')

<div class="row">
    <div class="col-md-4">
        @include('Dashboard.Sidebar')
    </div>
    <div class="col-md-8">
        <h1>Welcom {{ Auth::user()->name }}!</h1>
    </div>
</div>


@endsection