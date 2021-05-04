@extends('layout.master')

@section('titlle',$title)

@section('content')
    <h1>{{$title}}</h1>
    @include('components.socialButton')
    @include('components.ValidatorErrorMassges')

    <label>
        商品名稱:
        {{old($Merchandise->name)}}>
    </label><br><br>
<label>
    商品介紹:<br>
    {($Merchandise->introduction)}}>
</label><br><br>

<label>
    商品照片:<br>
    <img src="{{$Merchandise->photo }}">
</label><br><br>
<label>

<label>
    商品價格:
    {{$merchandise->price}}
</label><br><br>

<label>
    商品剩餘數量:
    {{$Merchandise->remain_count}}>
</label><br><br>

<form action = "merchandise/{{$Merchandise->id}}/buy" method = "post" enctype="multipart/form-data">
    {!! csrf_field() !!}
<label>
    購買數量:
    <select name="buy_count">
    @for($count=1; $count<=$Merchandise->remain_count; $count++)
        <option value="{{$count}}">{{$count}}</option>
    @endfor
</label>

<input type="submit" value="更新商品資料">
@endsecion
