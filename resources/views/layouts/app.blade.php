<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>LOL戰棋</title>
</head>

<body>
    <div id="app">
        <div class="row">
            @yield('left-sideBar')
            @yield('body-content')
        </div>
    </div>
</body>
<script src="/js/app.js"></script>

</html>
