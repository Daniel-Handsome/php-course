<!DOCTYPE html>
<html>
    <head>
        <meta charset="urf-8">
        <title>@yield('title') - Shop Laravel </title>
        <link rel="stylesheet" href="/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    </head>
    <body>
        <header>
            <a  class="btn btn-primary" href="#">註冊</a>
            <a   class="btn btn-primary"href="#">登入</a>
        </header>

        <div class="container">
            @yield('content')
        </div>

        <footer>
            <a href="#">聯絡我們</a>

        </footer>
        </body>
        <script src="/jquery-3.5.1.min"></script>
        <script src="/js/bootstrap.min.js"></script>
</html>
