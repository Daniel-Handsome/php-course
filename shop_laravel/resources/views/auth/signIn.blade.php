@extends('layout.Master')

@section('title',$title)

@section('content')
    <h1>{{$title}}</h1>
    @include('components.socialButton')
    @include('components.ValidatorErrorMassges')

    <form action="/user/auth/sign-in" method="POST">

    {!! csrf_field() !!}


    Email:
    <input type="text" name="email" placeholder="Email" value="{{old('email')}}"><br>
    密碼:
    <input type="password" name="password" placeholder="密碼" value="{{old('email')}}"<br>
    <br>
    <br>
    <input type="submit" value="登入">
    </form>

    <ul class="nav">
        @if (session()->has('user_id'))
            <li><a href="user/auth/sign-out">登出</a></li>
        @else
            <li><a href="user/auth/sign-in">登入</a></li>
            <li><a href="user/auth/sign-up">註冊</a></li>
        @endif
    </ul>
@endsection
