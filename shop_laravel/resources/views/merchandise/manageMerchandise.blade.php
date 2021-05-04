@extends('layout.master')

@section('titlle',$title)

@section('content')
    <h1>{{$title}}</h1>
    @include('components.socialButton')
    @include('components.ValidatorErrorMassges')
    <table border="1" cellpadding="5">
        <tr>
            <th>編號</th>
            <th>名稱</th>
            <th>圖片</th>
            <th>狀態</th>
            <th>價格</th>
            <th>剩餘數量</th>
            <th>編輯</th>
        </tr>
        foreach($MerchdisePaginate as $Merchdise)
        <tr>
            <td>{{$Merchdise->id}}</td>
            <td>{{$Merchdise->name}}</td>
            <td><img width="250" src="{{$Merchdise->photo}}"></td>
            <td>
                @if($Merchdise->status =="C")
                建立中
                @else
                可銷售
                @endif

            </td>
            <td>{{$Merchdise_price}}</td>
            <td>{{$Merchdise_remain_count}}</td>
            <td><a href="merchdis/{{$Merchdise->id}}/edit">編輯</td>

        </tr>
    </table>

        {{$MerchdisePaginate->link()}}
@endsecion
