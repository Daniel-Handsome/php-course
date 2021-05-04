@extends('layout.master')

@section('titlle',$title)

@section('content')
    <h1>{{$title}}</h1>
    @include('components.socialButton')
    @include('components.ValidatorErrorMassges')

    <form action = "merchandise/{{$Merchandise->id}}" method = "post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    {{method_field('PUT')}}

    <label>
        商品狀態:
        <select name="status">
            <option value="C">建立中</option>
            <option value="S">可販售</option>
        </select>
    </label><br><br>

    <label>
        商品名稱:
        <input type="text" name = "neme" placeholder="商品名稱" value="{{old('name',$Merchandise->name)}}">
    </label><br><br>

    <label>
    商品英文名稱:
    <input type="text" name = "neme_en" placeholder="商品英文名稱" value="{{old('name',$Merchandise->name_en)}}">
</label><br><br>

<label>
    商品介紹:
    <input type="text" name = "introduction" placeholder="商品介紹" value="{{old('name',$Merchandise->introduction)}}">
</label><br><br>

<label>
    商品英文介紹:
    <input type="text" name = "introducion_en" placeholder="商品英文介紹" value="{{ old('introduction',$Merchandise->introduction_en)}}">
</label><br><br>

<label>
    商品照片:
    <input type="file" name = "photo" placeholder="商品照片" >
    <img src="{{$Merchandise->photo }}">

</label><br><br>

<label>
    商品商品價格:
    <input type="text" name = "price" placeholder="商品價格" value="{{ old('price',$Merchandise->price)}}">
</label><br><br>

<label>
    商品商品剩餘數量:
    <input type="text" name = "remain_count" placeholder="商品剩餘數量" value="{{ old('remin_count',$Merchandise->remain_count)}}">
</label><br><br>

<input type="submit" value="更新商品資料">
@endsecion
