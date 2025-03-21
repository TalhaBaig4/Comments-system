<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:title" content="@yield('title')" />
    <meta name="description" content="@yield('meta_des')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>admin</title>
</head>
<body>
    
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                @include('Dashboard.Sidebar')
            </div>
            <div class="col-md-8">
                <h1 class="text-center text-danger">Welcom 
                    {{-- {{ isset(Auth::user()) ?? Auth::user()->name  }} --}}
                    @if (Auth::user())
                        {{ Auth::user()->name  }}
                    @else
                        {{'Admin SB'}}
                    @endif
                    🤗</h1>
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>

</body>
</html>