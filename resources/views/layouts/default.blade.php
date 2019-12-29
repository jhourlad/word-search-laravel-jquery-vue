<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <base href="/">
    <title>WordsAPI Search</title>
    <link href="//fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content vh-100">
        @yield('content')
    </div>
</div>
<script src="//kit.fontawesome.com/86a9d6f23f.js" crossorigin="anonymous"></script>
<script src="{{ asset('/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
