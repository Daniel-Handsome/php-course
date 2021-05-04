@extends('layout.master')

@section('titlle',$title)

@section('content')
    <h1>{{$title}}</h1>
    @include('components.socialButton')
    @include('components.ValidatorErrorMassges')
    <table border="1" cellpadding="5">
        <tr>
            <th>名稱</th>
            <th>圖片</th>
            <th>價格</th>
            <th>剩餘數量</th>
            <th>檢視</th>
        </tr>
        foreach($MerchdisePaginate as $Merchdise)
        <tr>
            <td>
                <a href="merchdis/{{$Merchdise->id}}/edit">
                    {{$Merchdise->name}}</a></td>
            <td><img width="250" src="{{$Merchdise->photo}}"></td>
            <td>{{$Merchdise_price}}</td>
            <td>{{$Merchdise_remain_count}}</td>

        </tr>
    </table>

        {{$MerchdisePaginate->link()}}
@endsecion
