@extends('layout.Master')

@section('title',$title)

@section('content')
    <h1>{{$title}}</h1>
    @include('components.socialButton')

    @include('components.ValidatorErrorMassges')

    <form action="/user/auth/sign-up" method="post">

    {!! csrf_field() !!}
    {!! '<a href="#">link</a>'  !!}
    {{ '<a href="#">link</a>' }}

    Email:
    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"><br>
    <br>
    密碼:
    <input type="password" name="password" placeholder="密碼"><br>
    <br>
    確認密碼:
    <input type="password" name="password_confirm" placeholder="確認密碼"><br>
    <br>
    暱稱:
    <input type="text" name="nickname" placeholder="暱稱" value="{{ old('nickname') }}"><br>
    <br>
    身分類型:
    <select name="type">
        <option value="G">一般會員</a>
        <option value="A">管理者</a>
    </select><br>
    <br>
    <input type="submit" value="註冊">

    </form>
@endsection
